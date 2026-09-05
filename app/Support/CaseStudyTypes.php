<?php

namespace App\Support;

class CaseStudyTypes
{
    public const WEBSITE = 'website';

    public const SOFTWARE = 'software';

    public const TRAINING = 'training';

    public const INFRASTRUCTURE = 'infrastructure';

    public const REPAIR = 'repair';

    public const SUPPORT = 'support';

    public static function all(): array
    {
        return [
            self::WEBSITE => [
                'label' => 'Website',
                'badge' => 'Web',
                'help' => 'Public site or landing page. Cover can be captured from the live URL.',
                'requires_url' => true,
                'cover_hint' => 'Paste the live URL and capture a screenshot, or upload a cover.',
            ],
            self::SOFTWARE => [
                'label' => 'Software',
                'badge' => 'Software',
                'help' => 'Custom apps, plugins, LMS, or automation tools.',
                'requires_url' => false,
                'cover_hint' => 'Upload a product UI screenshot. Extra screenshots go in the gallery.',
            ],
            self::TRAINING => [
                'label' => 'Training',
                'badge' => 'Training',
                'help' => 'Skills programmes, cohorts, and partner-led intakes.',
                'requires_url' => false,
                'cover_hint' => 'Upload a classroom, lab, or cohort photo.',
            ],
            self::INFRASTRUCTURE => [
                'label' => 'Infrastructure',
                'badge' => 'Infrastructure',
                'help' => 'Networking, cloud, hosting, and on-site installs.',
                'requires_url' => false,
                'cover_hint' => 'Upload a site photo, rack shot, or topology diagram.',
            ],
            self::REPAIR => [
                'label' => 'Repair',
                'badge' => 'Repair',
                'help' => 'One-off fixes, hardware repair, or data recovery.',
                'requires_url' => false,
                'cover_hint' => 'Upload a device or after-fix photo. Use the gallery for before/after.',
            ],
            self::SUPPORT => [
                'label' => 'Support',
                'badge' => 'Support',
                'help' => 'Ongoing managed IT, helpdesk, or retainer outcomes.',
                'requires_url' => false,
                'cover_hint' => 'Upload a client logo or team photo. Cover is optional.',
            ],
        ];
    }

    public static function keys(): array
    {
        return array_keys(self::all());
    }

    public static function options(): array
    {
        return collect(self::all())->mapWithKeys(fn ($meta, $key) => [$key => $meta['label']])->all();
    }

    public static function label(string $type): string
    {
        return self::all()[$type]['label'] ?? ucfirst($type);
    }

    public static function badge(string $type): string
    {
        return self::all()[$type]['badge'] ?? self::label($type);
    }

    public static function meta(string $type): array
    {
        return self::all()[$type] ?? self::all()[self::WEBSITE];
    }

    public static function normalizeMeta(string $type, array $input): array
    {
        $input = $input ?: [];

        return match ($type) {
            self::WEBSITE => [
                'tech_stack' => trim((string) ($input['tech_stack'] ?? '')),
                'before_url' => trim((string) ($input['before_url'] ?? '')),
            ],
            self::SOFTWARE => [
                'platform' => trim((string) ($input['platform'] ?? '')),
                'product_name' => trim((string) ($input['product_name'] ?? '')),
                'demo_url' => trim((string) ($input['demo_url'] ?? '')),
            ],
            self::TRAINING => [
                'partners' => trim((string) ($input['partners'] ?? '')),
                'cohort_size' => trim((string) ($input['cohort_size'] ?? '')),
                'completion_rate' => trim((string) ($input['completion_rate'] ?? '')),
                'employment_rate' => trim((string) ($input['employment_rate'] ?? '')),
                'programme_dates' => trim((string) ($input['programme_dates'] ?? '')),
            ],
            self::INFRASTRUCTURE => [
                'location' => trim((string) ($input['location'] ?? '')),
                'scope' => array_values(array_filter(array_map('strval', (array) ($input['scope'] ?? [])))),
            ],
            self::REPAIR => [
                'device_type' => trim((string) ($input['device_type'] ?? '')),
                'fault_category' => trim((string) ($input['fault_category'] ?? '')),
                'turnaround' => trim((string) ($input['turnaround'] ?? '')),
            ],
            self::SUPPORT => [
                'sla_tier' => trim((string) ($input['sla_tier'] ?? '')),
                'tickets_before' => trim((string) ($input['tickets_before'] ?? '')),
                'tickets_after' => trim((string) ($input['tickets_after'] ?? '')),
                'response_time' => trim((string) ($input['response_time'] ?? '')),
                'contract_duration' => trim((string) ($input['contract_duration'] ?? '')),
            ],
            default => [],
        };
    }

    public static function infrastructureScopeOptions(): array
    {
        return [
            'lan' => 'LAN / cabling',
            'wifi' => 'Wi-Fi',
            'firewall' => 'Firewall',
            'vpn' => 'VPN',
            'servers' => 'Servers',
            'cloud' => 'Cloud / hosting',
            'backup' => 'Backup',
            'cctv' => 'CCTV / access',
        ];
    }

    public static function softwarePlatforms(): array
    {
        return [
            'web_app' => 'Web application',
            'wordpress_plugin' => 'WordPress plugin',
            'saas' => 'SaaS / portal',
            'desktop' => 'Desktop app',
            'automation' => 'Automation / integration',
            'other' => 'Other',
        ];
    }

    public static function repairDevices(): array
    {
        return [
            'laptop' => 'Laptop',
            'desktop' => 'Desktop',
            'server' => 'Server',
            'printer' => 'Printer',
            'network' => 'Network device',
            'pos' => 'POS / terminal',
            'other' => 'Other',
        ];
    }

    public static function repairFaults(): array
    {
        return [
            'wont_boot' => "Won't boot",
            'screen' => 'Screen / display',
            'storage' => 'Storage / drive',
            'malware' => 'Malware / virus',
            'power' => 'Power',
            'network' => 'Network drop',
            'data_recovery' => 'Data recovery',
            'other' => 'Other',
        ];
    }
}
