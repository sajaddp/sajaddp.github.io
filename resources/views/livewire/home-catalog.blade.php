@php
    $latestVideos = collect($courses)
        ->flatMap(function (array $course) {
            return collect($course['videos'])->map(function (array $video) use ($course): array {
                return $video + [
                    'course' => [
                        'title' => $course['title'],
                        'slug' => $course['slug'],
                    ],
                ];
            });
        })
        ->take(6);
@endphp

<section class="flex flex-col gap-12">
    <div class="flex flex-col gap-3">
        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-emerald-700">شبکه دوره ها</p>
        <h2 class="text-3xl font-bold text-slate-900">مسیرهای یادگیری منظم، مشابه تجربه Laracasts.</h2>
        <p class="max-w-3xl text-sm leading-relaxed text-slate-600">هر دوره با داستان منسجم و پیش نمایش اپیزودهای تازه منتشر شده ارائه می‌شود.</p>
    </div>

    <div class="grid gap-6">
        @forelse ($courses as $course)
            <article class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg" wire:key="course-{{ $course['id'] }}">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-50 via-transparent to-white opacity-0 transition duration-300 group-hover:opacity-100"></div>
                <div class="relative flex flex-col gap-4">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <div class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-emerald-700 ring-1 ring-emerald-200">
                                دوره ویژه
                                <span class="h-1 w-1 rounded-full bg-emerald-500"></span>
                                {{ count($course['videos']) }} اپیزود
                            </div>
                            <a class="text-2xl font-bold text-slate-900 transition hover:text-emerald-700" href="{{ route('courses.show', $course['slug']) }}">
                                {{ $course['title'] }}
                            </a>
                            @if (!empty($course['description']))
                                <p class="max-w-3xl text-sm leading-relaxed text-slate-600">{{ $course['description'] }}</p>
                            @endif
                        </div>
                        <a class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-900 transition hover:border-emerald-200 hover:text-emerald-700" href="{{ route('courses.show', $course['slug']) }}">
                            مشاهده دوره
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (collect($course['videos'])->take(3) as $video)
                            <a class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 transition hover:border-emerald-200 hover:bg-emerald-50" href="{{ route('videos.show', $video['slug']) }}" wire:key="course-{{ $course['id'] }}-video-{{ $video['id'] }}">
                                <div class="flex flex-col gap-1">
                                    <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-700">اپیزود</span>
                                    <span class="line-clamp-1 font-semibold">{{ $video['title'] }}</span>
                                </div>
                                <span class="rounded-full bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-emerald-700 ring-1 ring-emerald-100">
                                    {{ $video['source'] === 'aparat' ? 'Aparat' : 'YouTube' }}
                                </span>
                            </a>
                        @endforeach
                        @if (empty($course['videos']))
                            <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-4 py-5 text-center text-xs text-slate-500">
                                هنوز ویدیویی برای این دوره ثبت نشده است.
                            </div>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-3xl border border-dashed border-white/15 bg-white/5 p-10 text-center text-sm text-slate-300">
                هنوز دوره ای اضافه نشده است. اولین دوره و ویدیوها را از پنل ادمین بساز.
            </div>
        @endforelse
    </div>

    <div class="flex flex-col gap-3">
        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-cyan-700">آخرین انتشار</p>
        <h3 class="text-2xl font-bold text-slate-900">تازه‌ترین ویدیوها، آماده تماشا و دانلود منابع.</h3>
        <p class="max-w-3xl text-sm leading-relaxed text-slate-600">برای هر ویدیو صفحه اختصاصی، متن توضیح و لینک منبع اصلی فراهم است.</p>
    </div>

    @if ($latestVideos->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-10 text-center text-sm text-slate-500">
            هنوز ویدیویی اضافه نشده است.
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($latestVideos as $video)
                <a class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg" href="{{ route('videos.show', $video['slug']) }}" wire:key="latest-video-{{ $video['id'] }}">
                    <div class="relative aspect-video w-full overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
                        @if (!empty($video['thumbnail_url']))
                            <img class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]" src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }} thumbnail">
                        @else
                            <div class="flex h-full items-center justify-center text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Preview</div>
                        @endif
                        <span class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.16em] text-slate-900 ring-1 ring-slate-200">
                            {{ $video['source'] === 'aparat' ? 'Aparat' : 'YouTube' }}
                        </span>
                    </div>
                    <div class="flex flex-1 flex-col gap-2 p-4">
                        <p class="text-base font-semibold text-slate-900">{{ $video['title'] }}</p>
                        @if (!empty($video['course']))
                            <a class="text-xs font-semibold text-emerald-700 transition hover:text-emerald-800" href="{{ route('courses.show', $video['course']['slug']) }}">
                                {{ $video['course']['title'] }}
                            </a>
                        @endif
                        <span class="mt-auto inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-800 ring-1 ring-emerald-200">
                            صفحه ویدیو
                            <span aria-hidden="true">&rarr;</span>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>
