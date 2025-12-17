<?php

use App\Models\Course;
use App\Models\Video;
use App\VideoSource;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders the home page with course and video content', function () {
    $course = Course::factory()->create([
        'title' => 'دوره تستی',
    ]);

    $video = Video::factory()->create([
        'course_id' => $course->id,
        'title' => 'ویدیوی تستی',
    ]);

    $response = $this->get(route('home'));

    $response->assertSuccessful()
        ->assertSee($course->title)
        ->assertSee($video->title);
});

it('renders the videos index with links to video pages', function () {
    $video = Video::factory()->create();

    $response = $this->get(route('videos.index'));

    $response->assertSuccessful()
        ->assertSee(route('videos.show', $video))
        ->assertSee($video->title);
});

it('renders the video page with an embed for youtube', function () {
    $video = Video::factory()->create([
        'source' => VideoSource::Youtube,
        'youtube_url' => 'https://www.youtube.com/watch?v=abc123',
    ]);

    $response = $this->get(route('videos.show', $video));

    $response->assertSuccessful()
        ->assertSee('https://www.youtube.com/embed/abc123');
});

it('renders the video page with an embed for aparat', function () {
    $video = Video::factory()->create([
        'source' => VideoSource::Aparat,
        'youtube_url' => 'https://www.aparat.com/v/xyz789',
    ]);

    $response = $this->get(route('videos.show', $video));

    $response->assertSuccessful()
        ->assertSee('https://www.aparat.com/video/video/embed/videohash/xyz789/vt/frame');
});

it('renders the course page with body and videos', function () {
    $course = Course::factory()->create([
        'title' => 'دوره پیشرفته',
        'body' => 'توضیحات کامل دوره',
    ]);

    $video = Video::factory()->create([
        'course_id' => $course->id,
        'title' => 'ویدیوی دوره',
    ]);

    $response = $this->get(route('courses.show', $course));

    $response->assertSuccessful()
        ->assertSee($course->title)
        ->assertSee($course->body)
        ->assertSee($video->title);
});

it('returns a valid sitemap with public urls', function () {
    $course = Course::factory()->create();
    $video = Video::factory()->create([
        'course_id' => $course->id,
    ]);

    $response = $this->get(route('sitemap'));

    $response->assertSuccessful()
        ->assertHeaderContains('Content-Type', 'application/xml')
        ->assertSee(route('home'))
        ->assertSee(route('videos.index'))
        ->assertSee(route('courses.show', $course))
        ->assertSee(route('videos.show', $video));
});
