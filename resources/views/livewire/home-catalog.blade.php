<section class="flex flex-col gap-10">
    <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-semibold text-slate-950">دوره های جدید</h2>
        <p class="text-sm text-slate-600">جدیدترین محتوا را ببین و مستقیم به یوتیوب برو.</p>
    </div>

    <div class="grid gap-6">
        @forelse ($courses as $course)
            <article class="rounded-3xl border border-slate-900/10 bg-white/70 p-6 shadow-sm backdrop-blur" wire:key="course-{{ $course['id'] }}">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="flex flex-col gap-2">
                        <a class="text-xl font-semibold text-slate-900 hover:text-amber-700" href="{{ route('courses.show', $course['id']) }}">
                            {{ $course['title'] }}
                        </a>
                        @if (!empty($course['description']))
                            <p class="max-w-3xl text-sm text-slate-600">{{ $course['description'] }}</p>
                        @endif
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                        {{ count($course['videos']) }} ویدیو
                    </span>
                </div>

                <div class="grid gap-4 pt-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($course['videos'] as $video)
                        <a class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-900/10 bg-white transition hover:-translate-y-1 hover:border-slate-900/20 hover:shadow-lg" href="{{ $video['url'] }}" target="_blank" rel="noopener" wire:key="video-{{ $video['id'] }}">
                            <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                                @if (!empty($video['thumbnail_url']))
                                    <img class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]" src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }} thumbnail">
                                @else
                                    <div class="flex h-full items-center justify-center text-sm font-medium text-slate-400">به زودی تامبنیل</div>
                                @endif
                            </div>
                            <div class="flex flex-1 flex-col gap-2 p-4">
                                <p class="text-base font-semibold text-slate-900">{{ $video['title'] }}</p>
                                <span class="text-xs font-medium uppercase tracking-[0.2em] text-amber-700">
                                    تماشا در {{ $video['source'] === 'aparat' ? 'آپارات' : ($video['source'] === 'youtube' ? 'یوتیوب' : 'منبع خارجی') }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </article>
        @empty
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white/70 p-10 text-center text-sm text-slate-500">
                هنوز دوره ای اضافه نشده است. اولین دوره و ویدیوها را از پنل ادمین بساز.
            </div>
        @endforelse
    </div>
</section>
