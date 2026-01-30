<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class SitemapController extends Controller
{
    /**
     * Generate and return the sitemap XML
     */
    public function index()
    {
        $baseUrl = config('app.url');
        $urls = [];

        // Static pages with their priorities and change frequencies
        $staticPages = [
            ['url' => '', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => 'about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => 'contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => 'services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => 'gallery', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => 'career-mapping', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => 'opportunities', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => 'announcements', 'priority' => '0.7', 'changefreq' => 'daily'],
            ['url' => 'terms', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => 'drones', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => 'internship', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => 'events', 'priority' => '0.7', 'changefreq' => 'weekly'],
        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => $baseUrl . '/' . $page['url'],
                'lastmod' => now()->toAtomString(),
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority'],
            ];
        }

        // Dynamic service pages
        try {
            $services = Service::all();
            foreach ($services as $service) {
                $slug = str_replace(' ', '-', strtolower($service->name));
                $urls[] = [
                    'loc' => $baseUrl . '/services/' . $slug,
                    'lastmod' => $service->updated_at ? $service->updated_at->toAtomString() : now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ];
            }
        } catch (\Throwable $e) {
            // Silently fail if database is unavailable
        }

        // Blog listing page
        $urls[] = [
            'loc' => $baseUrl . '/blogs',
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.7',
        ];

        // Blog posts
        try {
            $blogs = Blog::all();
            foreach ($blogs as $blog) {
                $urls[] = [
                    'loc' => $baseUrl . '/blogs/displayblog/' . $blog->id,
                    'lastmod' => $blog->updated_at ? $blog->updated_at->toAtomString() : now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ];
            }
        } catch (\Throwable $e) {
            // Silently fail if database is unavailable
        }

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            $xml .= "    <lastmod>" . htmlspecialchars($url['lastmod']) . "</lastmod>\n";
            $xml .= "    <changefreq>" . htmlspecialchars($url['changefreq']) . "</changefreq>\n";
            $xml .= "    <priority>" . htmlspecialchars($url['priority']) . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
