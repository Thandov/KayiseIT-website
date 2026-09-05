<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Occupations;
use App\Models\Service;
use App\Models\ServiceTier;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Generate and return the sitemap XML.
     *
     * Only final, publicly reachable URLs are listed (no redirects).
     * lastmod is only emitted when we have a real timestamp for the content.
     */
    public function index()
    {
        $xml = Cache::remember('sitemap.xml', now()->addHour(), function () {
            return $this->buildXml();
        });

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    private function buildXml(): string
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $urls = [];

        // Static pages
        $staticPages = [
            ['url' => '', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => 'about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => 'contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => 'services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => 'training-skills', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => 'gallery', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => 'career-mapping', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => 'opportunities', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => 'programs', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => 'announcements', 'priority' => '0.7', 'changefreq' => 'daily'],
            ['url' => 'case-studies', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => 'internship', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => 'events', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => 'drones', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => 'harambean', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['url' => 'lms/certification', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => 'blogs', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => 'terms', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => 'privacy', 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        // Hand-written SEO landing pages (explicit routes in routes/web.php)
        $seoLandingPages = [
            'services/drone-building-course-south-africa',
            'services/ict-training-for-tvet-colleges',
            'services/4ir-skills-training',
            'services/cyber-security-training-south-africa',
            'services/microsoft-office-productivity-training',
            'services/website-development-south-africa',
            'services/it-consulting-south-africa',
        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => $baseUrl . '/' . $page['url'],
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority'],
            ];
        }

        foreach ($seoLandingPages as $path) {
            $urls[] = [
                'loc' => $baseUrl . '/' . $path,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        // Dashboard-created services: canonical URL is the Small tier page.
        // Only include services that actually have a Small tier (others 404).
        try {
            $services = Service::with('tiers')->get();
            foreach ($services as $service) {
                $hasSmallTier = $service->tiers->contains('tier_key', ServiceTier::TIER_SMALL);
                if (! $hasSmallTier) {
                    continue;
                }

                $urls[] = [
                    'loc' => $baseUrl . '/services/' . $service->publicSlug() . '/' . ServiceTier::TIER_SMALL,
                    'lastmod' => optional($service->updated_at)->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ];
            }
        } catch (\Throwable $e) {
            // Skip if database is unavailable
        }

        // Career pages
        try {
            $occupations = Occupations::published()->whereNotNull('slug')->get();
            foreach ($occupations as $occupation) {
                $urls[] = [
                    'loc' => $baseUrl . '/careers/' . $occupation->slug,
                    'lastmod' => optional($occupation->updated_at)->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ];
            }
        } catch (\Throwable $e) {
            // Skip if database is unavailable
        }

        // Blog posts
        try {
            $blogs = Blog::orderByDesc('created_at')->get();
            foreach ($blogs as $blog) {
                $urls[] = [
                    'loc' => $baseUrl . '/blogs/displayblog/' . $blog->id,
                    'lastmod' => optional($blog->updated_at)->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ];
            }
        } catch (\Throwable $e) {
            // Skip if database is unavailable
        }

        // Case studies
        try {
            $caseStudies = CaseStudy::published()->whereNotNull('slug')->orderByDesc('updated_at')->get();
            foreach ($caseStudies as $caseStudy) {
                $urls[] = [
                    'loc' => $baseUrl . '/case-studies/' . $caseStudy->slug,
                    'lastmod' => optional($caseStudy->updated_at)->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ];
            }
        } catch (\Throwable $e) {
            // Skip if database is unavailable
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            if (! empty($url['lastmod'])) {
                $xml .= "    <lastmod>" . htmlspecialchars($url['lastmod']) . "</lastmod>\n";
            }
            $xml .= "    <changefreq>" . htmlspecialchars($url['changefreq']) . "</changefreq>\n";
            $xml .= "    <priority>" . htmlspecialchars($url['priority']) . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
