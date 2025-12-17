<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Services\VideoCatalogService;
use Illuminate\Contracts\View\View;

class VideoController extends Controller
{
    public function show(Video $video, VideoCatalogService $videoCatalogService): View
    {
        $payload = $videoCatalogService->getVideoPagePayload($video);

        return view('videos.show', $payload);
    }
}
