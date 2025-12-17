<?php

namespace App\Livewire;

use App\Services\VideoCatalogService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class VideosIndex extends Component
{
    /**
     * @var list<array{
     *     id: int,
     *     title: string,
     *     source: string,
     *     url: string,
     *     thumbnail_url: string|null,
     *     course: array{
     *         id: int,
     *         title: string
     *     }|null
     * }>
     */
    public array $videos = [];

    public function mount(VideoCatalogService $videoCatalogService): void
    {
        $this->videos = $videoCatalogService->getAllVideos();
    }

    public function render(): View
    {
        return view('livewire.videos-index');
    }
}
