<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class HomeCatalog extends Component
{
    /**
     * @var list<array{
     *     id: int,
     *     title: string,
     *     description: string|null,
     *     body: string|null,
     *     videos: list<array{
     *         id: int,
     *         title: string,
     *         source: string,
     *         url: string,
     *         thumbnail_url: string|null
     *     }>
     * }>
     */
    public array $courses = [];

    public function render(): View
    {
        return view('livewire.home-catalog');
    }
}
