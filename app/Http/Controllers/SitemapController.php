<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $lastVideo = Video::query()->latest('updated_at')->first();
        $lastCourse = Course::query()->latest('updated_at')->first();
        $lastModified = collect([$lastVideo?->updated_at, $lastCourse?->updated_at])
            ->filter()
            ->max()
            ?->toAtomString() ?? now()->toAtomString();

        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => $lastModified,
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('videos.index'),
                'lastmod' => $lastModified,
                'changefreq' => 'daily',
                'priority' => '0.8',
            ],
        ];

        $courseUrls = Course::query()
            ->latest('updated_at')
            ->get()
            ->map(function (Course $course): array {
                return [
                    'loc' => route('courses.show', $course),
                    'lastmod' => $course->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            });

        $videoUrls = Video::query()
            ->latest('updated_at')
            ->get()
            ->map(function (Video $video): array {
                return [
                    'loc' => route('videos.show', $video),
                    'lastmod' => $video->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            });

        return response()
            ->view('sitemap', ['urls' => array_merge($urls, $courseUrls->all(), $videoUrls->all())])
            ->header('Content-Type', 'application/xml');
    }
}
