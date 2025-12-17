<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\VideoCatalogService;
use Illuminate\Contracts\View\View;

class CourseController extends Controller
{
    public function show(Course $course, VideoCatalogService $videoCatalogService): View
    {
        $payload = $videoCatalogService->getCoursePagePayload($course);

        return view('courses.show', $payload);
    }
}
