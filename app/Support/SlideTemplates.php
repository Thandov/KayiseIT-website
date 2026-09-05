<?php

namespace App\Support;

class SlideTemplates
{
    public const CLASSIC = 'classic';
    public const EDITORIAL = 'editorial';
    public const CAMPAIGN = 'campaign';

    public static function keys(): array
    {
        return [self::CLASSIC, self::EDITORIAL, self::CAMPAIGN];
    }

    public static function all(): array
    {
        return [
            self::CLASSIC => [
                'key' => self::CLASSIC,
                'label' => 'Classic overlay',
                'tagline' => 'Standard homepage hero',
                'use_when' => 'Use when you are writing the message: kicker, headline, supporting line, and a button over a darkened photo.',
                'requires_copy' => true,
            ],
            self::EDITORIAL => [
                'key' => self::EDITORIAL,
                'label' => 'Editorial caption',
                'tagline' => 'Photo first, copy second',
                'use_when' => 'Use when the photograph should stay visible. A compact caption bar carries the headline and button.',
                'requires_copy' => false,
            ],
            self::CAMPAIGN => [
                'key' => self::CAMPAIGN,
                'label' => 'Campaign visual',
                'tagline' => 'The image is the slide',
                'use_when' => 'Use for event photography and designed posters that already have branding in-frame — like a symposium recap that should open the blog, not sit behind three lines of overlay text.',
                'requires_copy' => false,
            ],
        ];
    }
}
