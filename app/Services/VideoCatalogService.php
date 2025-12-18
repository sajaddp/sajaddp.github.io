<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Video;
use App\VideoSource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoCatalogService
{
    /**
     * @return array{
     *     courses: list<array{
     *         id: int,
     *         title: string,
     *         slug: string,
     *         description: string|null,
     *         body: string|null,
     *         videos: list<array{
     *             id: int,
     *             title: string,
     *             slug: string,
     *             source: string,
     *             url: string,
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
                    return $this->mapCourse($course);
                })
                ->all(),
            'jsonLd' => $this->buildHomepageJsonLd($courses),
        ];
    }

    /**
     * @return array{
     *     video: array{
     *         id: int,
     *         title: string,
     *         slug: string,
     *         source: string,
     *         url: string,
     *         embed_url: string|null,
     *         thumbnail_url: string|null,
     *         body: string|null,
     *         attachment_url: string|null
     *     },
     *     course: array{
     *         id: int,
     *         title: string
     *         slug: string
     *     }|null
     * }
     */
    public function getVideoPagePayload(Video $video): array
    {
        $video->loadMissing('course');

        return [
            'video' => [
                'id' => $video->id,
                'title' => $video->title,
                'slug' => $video->slug,
                'source' => ($video->source ?? VideoSource::Other)->value,
                'url' => $video->youtube_url,
                'embed_url' => $this->resolveEmbedUrl($video),
                'thumbnail_url' => $video->thumbnail_url,
                'body' => $video->body,
                'attachment_url' => $this->resolveAttachmentUrl($video),
            ],
            'course' => $video->course
                ? [
                    'id' => $video->course->id,
                    'title' => $video->course->title,
                    'slug' => $video->course->slug,
                ]
                : null,
        ];
    }

    /**
     * @return array{
     *     course: array{
     *         id: int,
     *         title: string,
     *         slug: string,
     *         description: string|null,
     *         body: string|null
     *     },
     *     videos: list<array{
     *         id: int,
     *         title: string,
     *         source: string,
     *         url: string,
     *         thumbnail_url: string|null
     *     }>
     * }
     */
    public function getCoursePagePayload(Course $course): array
    {
        $course->loadMissing(['videos' => function ($query) {
            $query->latest();
        }]);

        return [
            'course' => [
                'id' => $course->id,
                'title' => $course->title,
                'slug' => $course->slug,
                'description' => $course->description,
                'body' => $course->body,
            ],
            'videos' => $course->videos
                ->map(function (Video $video): array {
                    return $this->mapVideo($video, includeCourse: false);
                })
                ->all(),
        ];
    }

    /**
     * @return list<array{
     *     id: int,
     *     title: string,
     *     slug: string,
     *     description: string|null,
     *     body: string|null,
     *     videos_count: int
     * }>
     */
    public function getAllCourses(): array
    {
        return Course::query()
            ->withCount('videos')
            ->latest()
            ->get()
            ->map(function (Course $course): array {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'slug' => $course->slug,
                    'description' => $course->description,
                    'body' => $course->body,
                    'videos_count' => $course->videos_count,
                ];
            })
            ->all();
    }

    /**
     * @return list<array{
     *     id: int,
     *     title: string,
     *     slug: string,
     *     source: string,
     *     url: string,
     *     thumbnail_url: string|null,
     *     course: array{
     *         id: int,
     *         title: string
     *     }|null
     * }>
     */
    public function getAllVideos(): array
    {
        return Video::query()
            ->with('course')
            ->latest()
            ->get()
            ->map(function (Video $video): array {
                return $this->mapVideo($video);
            })
            ->unique('id')
            ->values()
            ->all();
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCoursesWithVideos(): Collection
    {
        return Course::query()
            ->with([
                'videos' => function ($query) {
                    $query->latest()->limit(3);
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

    /**
     * @return array{
     *     id: int,
     *     title: string,
     *     slug: string,
     *     description: string|null,
     *     body: string|null,
     *     videos: list<array{
     *         id: int,
     *         title: string,
     *         source: string,
     *         url: string,
     *         thumbnail_url: string|null
     *     }>
     * }
     */
    protected function mapCourse(Course $course): array
    {
        return [
            'id' => $course->id,
            'title' => $course->title,
            'slug' => $course->slug,
            'description' => $course->description,
            'body' => $course->body,
            'videos' => $course->videos
                ->map(function (Video $video): array {
                    return $this->mapVideo($video, includeCourse: false);
                })
                ->all(),
        ];
    }

    /**
     * @return array{
     *     id: int,
     *     title: string,
     *     slug: string,
     *     source: string,
     *     url: string,
     *     thumbnail_url: string|null,
     *     course?: array{
     *         id: int,
     *         title: string
     *     }|null
     * }
     */
    protected function mapVideo(Video $video, bool $includeCourse = true): array
    {
        $payload = [
            'id' => $video->id,
            'title' => $video->title,
            'slug' => $video->slug,
            'source' => ($video->source ?? VideoSource::Other)->value,
            'url' => $video->youtube_url,
            'thumbnail_url' => $video->thumbnail_url,
        ];

        if ($includeCourse) {
            $payload['course'] = $video->relationLoaded('course') && $video->course
                ? [
                    'id' => $video->course->id,
                    'title' => $video->course->title,
                    'slug' => $video->course->slug,
                ]
                : null;
        }

        return $payload;
    }

    protected function resolveEmbedUrl(Video $video): ?string
    {
        if (blank($video->youtube_url)) {
            return null;
        }

        return match ($video->source ?? VideoSource::Other) {
            VideoSource::Youtube => $this->resolveYoutubeEmbedUrl($video->youtube_url),
            VideoSource::Aparat => $this->resolveAparatEmbedUrl($video->youtube_url),
            default => null,
        };
    }

    protected function resolveAttachmentUrl(Video $video): ?string
    {
        if (blank($video->attachment_path)) {
            return null;
        }

        return Storage::disk('public')->url($video->attachment_path);
    }

    protected function resolveYoutubeEmbedUrl(string $url): ?string
    {
        $videoId = $this->extractYoutubeId($url);

        if (blank($videoId)) {
            return null;
        }

        return sprintf('https://www.youtube.com/embed/%s', $videoId);
    }

    protected function resolveAparatEmbedUrl(string $url): ?string
    {
        $hash = $this->extractAparatHash($url);

        if (blank($hash)) {
            return null;
        }

        return sprintf('https://www.aparat.com/video/video/embed/videohash/%s/vt/frame', $hash);
    }

    protected function extractYoutubeId(string $url): ?string
    {
        $url = trim($url);

        if (Str::contains($url, 'youtu.be/')) {
            $path = parse_url($url, PHP_URL_PATH);

            return $path ? trim($path, '/') : null;
        }

        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query ?? '', $queryParams);

        if (! empty($queryParams['v'])) {
            return $queryParams['v'];
        }

        $path = parse_url($url, PHP_URL_PATH);

        if ($path && Str::startsWith($path, ['/embed/', '/shorts/'])) {
            $segments = explode('/', trim($path, '/'));

            return $segments[1] ?? null;
        }

        return null;
    }

    protected function extractAparatHash(string $url): ?string
    {
        if (preg_match('~aparat\\.com/(?:v|video/video/embed/videohash)/([^/?#]+)~i', $url, $matches) === 1) {
            return $matches[1];
        }

        $path = parse_url($url, PHP_URL_PATH);

        if ($path && preg_match('~/v/([^/]+)~', $path, $matches) === 1) {
            return $matches[1];
        }

        return null;
    }
}
