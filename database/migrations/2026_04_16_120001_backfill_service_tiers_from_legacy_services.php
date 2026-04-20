<?php

use App\Models\Service;
use App\Models\ServiceTier;
use App\Models\ServiceTierPage;
use App\Models\ServiceTierPrice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Service::query()->chunkById(50, function ($services) {
            foreach ($services as $service) {
                if (ServiceTier::where('service_id', $service->id)->exists()) {
                    continue;
                }

                DB::transaction(function () use ($service) {
                    $small = ServiceTier::create([
                        'service_id' => $service->id,
                        'tier_key' => ServiceTier::TIER_SMALL,
                        'label' => 'Small business',
                        'pricing_mode' => ServiceTier::MODE_FIXED,
                    ]);

                    if ($service->service_type === 'static' && $service->price !== null) {
                        ServiceTierPrice::create([
                            'service_tier_id' => $small->id,
                            'amount' => $service->price,
                        ]);
                    }

                    ServiceTierPage::create([
                        'service_tier_id' => $small->id,
                        'hero_heading' => $service->name,
                        'hero_subheading' => 'Tailored for small businesses.',
                        'body' => $service->description,
                        'primary_cta_label' => $service->service_type === 'static' ? 'Get started' : 'Contact us',
                        'primary_cta_href' => $service->service_type === 'static' ? '#pricing' : url('/contact'),
                    ]);

                    $medium = ServiceTier::create([
                        'service_id' => $service->id,
                        'tier_key' => ServiceTier::TIER_MEDIUM,
                        'label' => 'Medium business',
                        'pricing_mode' => ServiceTier::MODE_PACKAGES,
                    ]);

                    ServiceTierPage::create([
                        'service_tier_id' => $medium->id,
                        'hero_heading' => $service->name . ' — Medium',
                        'hero_subheading' => 'Packages and add-ons for growing teams.',
                        'body' => $service->description,
                        'primary_cta_label' => 'View packages',
                        'primary_cta_href' => '#packages',
                    ]);

                    $enterprise = ServiceTier::create([
                        'service_id' => $service->id,
                        'tier_key' => ServiceTier::TIER_ENTERPRISE,
                        'label' => 'Enterprise',
                        'pricing_mode' => ServiceTier::MODE_QUOTE,
                    ]);

                    ServiceTierPage::create([
                        'service_tier_id' => $enterprise->id,
                        'hero_heading' => $service->name . ' — Enterprise',
                        'hero_subheading' => 'Tender-based and custom engagements.',
                        'body' => $service->description,
                        'primary_cta_label' => 'Request a quote',
                        'primary_cta_href' => url('/contact'),
                    ]);
                });
            }
        });
    }

    public function down(): void
    {
        ServiceTier::query()->delete();
    }
};
