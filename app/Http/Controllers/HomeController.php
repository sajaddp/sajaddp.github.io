<?php

namespace App\Http\Controllers;

use App\Services\VideoCatalogService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(public VideoCatalogService $videoCatalogService) {}

    public function __invoke(): View
    {
        $payload = $this->videoCatalogService->getHomepagePayload();

        return view('welcome', [
            'courses' => $payload['courses'],
            'jsonLd' => $payload['jsonLd'],
        ]);
    }
}
