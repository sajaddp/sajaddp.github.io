<?php

namespace App\Livewire;

use App\Services\VideoCatalogService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CoursesIndex extends Component
{
    /**
     * @var list<array{
     *     id: int,
     *     title: string,
     *     slug: string,
     *     description: string|null,
     *     body: string|null,
     *     videos_count: int
     * }>
     */
    public array $courses = [];

    public function mount(VideoCatalogService $videoCatalogService): void
    {
        $this->courses = $videoCatalogService->getAllCourses();
    }

    public function render(): View
    {
        return view('livewire.courses-index');
    }
}
