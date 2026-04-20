<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServiceAddon;
use App\Models\ServicePackage;
use App\Models\ServicePackageFeature;
use App\Models\ServiceTier;
use App\Models\ServiceTierPage;
use App\Models\ServiceTierPrice;
use Illuminate\Http\Request;

class ServiceTierSyncService
{
    public function sync(Service $service, Request $request): void
    {
        $this->syncTier(
            $service,
            ServiceTier::TIER_SMALL,
            $request->input('tier_small', []),
            ServiceTier::MODE_FIXED
        );
        $this->syncTier(
            $service,
            ServiceTier::TIER_MEDIUM,
            $request->input('tier_medium', []),
            ServiceTier::MODE_PACKAGES
        );
        $this->syncTier(
            $service,
            ServiceTier::TIER_ENTERPRISE,
            $request->input('tier_enterprise', []),
            ServiceTier::MODE_QUOTE
        );

        $this->syncLegacyServiceColumns($service);
    }

    protected function syncLegacyServiceColumns(Service $service): void
    {
        $service->refresh();
        $service->load(['tiers.tierPrice', 'tiers.packages']);

        $small = $service->tiers->firstWhere('tier_key', ServiceTier::TIER_SMALL);
        $medium = $service->tiers->firstWhere('tier_key', ServiceTier::TIER_MEDIUM);

        $smallAmount = $small?->tierPrice?->amount;
        if ($smallAmount !== null && (float) $smallAmount > 0) {
            $service->service_type = 'static';
            $service->price = $smallAmount;
        } elseif ($medium && $medium->packages->isNotEmpty()) {
            $service->service_type = 'dynamic';
            $service->price = 0;
        } else {
            $service->service_type = 'dynamic';
            $service->price = $smallAmount ?? 0;
        }

        $service->saveQuietly();
    }

    protected function syncTier(Service $service, string $tierKey, array $data, string $defaultMode): void
    {
        $mode = $data['pricing_mode'] ?? $defaultMode;
        if (! in_array($mode, [ServiceTier::MODE_FIXED, ServiceTier::MODE_PACKAGES, ServiceTier::MODE_QUOTE], true)) {
            $mode = $defaultMode;
        }

        $tier = ServiceTier::updateOrCreate(
            ['service_id' => $service->id, 'tier_key' => $tierKey],
            [
                'label' => $data['label'] ?? null,
                'pricing_mode' => $mode,
            ]
        );

        ServiceTierPrice::where('service_tier_id', $tier->id)->delete();

        if ($mode === ServiceTier::MODE_FIXED && isset($data['amount']) && $data['amount'] !== '' && $data['amount'] !== null) {
            ServiceTierPrice::create([
                'service_tier_id' => $tier->id,
                'amount' => $data['amount'],
            ]);
        }

        if ($tierKey === ServiceTier::TIER_MEDIUM) {
            ServicePackage::where('service_tier_id', $tier->id)->delete();
            foreach ($this->normalizeRepeater($data['packages'] ?? []) as $i => $pkg) {
                if (empty($pkg['name'])) {
                    continue;
                }
                $package = ServicePackage::create([
                    'service_tier_id' => $tier->id,
                    'name' => $pkg['name'],
                    'price' => $pkg['price'] ?? 0,
                    'description' => $pkg['description'] ?? null,
                    'sort_order' => $i,
                ]);
                $featuresText = $pkg['features'] ?? '';
                if (is_string($featuresText) && $featuresText !== '') {
                    $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $featuresText)));
                    foreach ($lines as $fi => $line) {
                        ServicePackageFeature::create([
                            'service_package_id' => $package->id,
                            'feature' => $line,
                            'sort_order' => $fi,
                        ]);
                    }
                }
            }

            ServiceAddon::where('service_tier_id', $tier->id)->delete();
            foreach ($this->normalizeRepeater($data['addons'] ?? []) as $i => $row) {
                if (empty($row['name'])) {
                    continue;
                }
                $ptype = ($row['pricing_type'] ?? ServiceAddon::PRICING_FIXED) === ServiceAddon::PRICING_QUANTITY
                    ? ServiceAddon::PRICING_QUANTITY
                    : ServiceAddon::PRICING_FIXED;
                ServiceAddon::create([
                    'service_tier_id' => $tier->id,
                    'name' => $row['name'],
                    'price' => $row['price'] ?? 0,
                    'pricing_type' => $ptype,
                    'unit_label' => $row['unit_label'] ?? null,
                    'min_qty' => isset($row['min_qty']) && $row['min_qty'] !== '' ? (int) $row['min_qty'] : null,
                    'max_qty' => isset($row['max_qty']) && $row['max_qty'] !== '' ? (int) $row['max_qty'] : null,
                    'sort_order' => $i,
                ]);
            }
        }

        $page = $data['page'] ?? [];
        $sections = null;
        if (! empty($page['sections_json']) && is_string($page['sections_json'])) {
            $decoded = json_decode($page['sections_json'], true);
            $sections = is_array($decoded) ? $decoded : null;
        }

        ServiceTierPage::updateOrCreate(
            ['service_tier_id' => $tier->id],
            [
                'meta_title' => $page['meta_title'] ?? null,
                'meta_description' => $page['meta_description'] ?? null,
                'hero_heading' => $page['hero_heading'] ?? null,
                'hero_subheading' => $page['hero_subheading'] ?? null,
                'body' => $page['body'] ?? null,
                'sections' => $sections,
                'primary_cta_label' => $page['primary_cta_label'] ?? null,
                'primary_cta_href' => $page['primary_cta_href'] ?? null,
            ]
        );
    }

    protected function normalizeRepeater($rows): array
    {
        if (! is_array($rows)) {
            return [];
        }

        return array_values($rows);
    }
}
