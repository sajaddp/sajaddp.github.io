<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Support\Collection;

class VideoCatalogService
{
    /**
     * @return array{
     *     courses: list<array{
     *         id: int,
     *         title: string,
     *         description: string|null,
     *         videos: list<array{
     *             id: int,
     *             title: string,
     *             youtube_url: string,
     *             thumbnail_url: string|null
     *         }>
     *     }>,
     *     jsonLd: array<string, mixed>
     * }
     */
    public function getHomepagePayload(): array
    {
        $courses = $this->getCoursesWithVideos();

        return [
            'courses' => $courses
                ->map(function (Course $course): array {
                    return [
                        'id' => $course->id,
                        'title' => $course->title,
                        'description' => $course->description,
                        'videos' => $course->videos
                            ->map(function (Video $video): array {
                                return [
                                    'id' => $video->id,
                                    'title' => $video->title,
                                    'youtube_url' => $video->youtube_url,
                                    'thumbnail_url' => $video->thumbnail_url,
                                ];
                            })
                            ->all(),
                    ];
                })
                ->all(),
            'jsonLd' => $this->buildHomepageJsonLd($courses),
        ];
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCoursesWithVideos(): Collection
    {
        return Course::query()
            ->with([
                'videos' => function ($query) {
                    $query->latest();
                },
            ])
            ->latest()
            ->get();
    }

    /**
     * @param  Collection<int, Course>  $courses
     * @return array<string, mixed>
     */
    public function buildHomepageJsonLd(Collection $courses): array
    {
        $items = $courses
            ->values()
            ->map(function (Course $course, int $index): array {
                $courseData = [
                    '@type' => 'Course',
                    'name' => $course->title,
                    'description' => $course->description,
                    'hasPart' => $course->videos
                        ->map(function (Video $video): array {
                            return array_filter([
                                '@type' => 'VideoObject',
                                'name' => $video->title,
                                'thumbnailUrl' => $video->thumbnail_url,
                                'contentUrl' => $video->youtube_url,
                                'uploadDate' => $video->created_at?->toAtomString(),
                            ], function ($value): bool {
                                return $value !== null && $value !== '';
                            });
                        })
                        ->all(),
                ];

                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'item' => array_filter($courseData, function ($value): bool {
                        return $value !== null && $value !== '';
                    }),
                ];
            })
            ->all();

        return [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'itemListElement' => $items,
        ];
    }
}
