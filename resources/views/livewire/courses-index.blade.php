<section class="flex flex-col gap-10">
    <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-semibold text-slate-950">همه دوره ها</h2>
        <p class="text-sm text-slate-600">فهرست کامل دوره ها را ببین و وارد صفحه هر دوره شو.</p>
    </div>

    @if (empty($courses))
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white/70 p-10 text-center text-sm text-slate-500">
            هنوز دوره ای اضافه نشده است.
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($courses as $course)
                <a class="group flex h-full flex-col rounded-2xl border border-slate-900/10 bg-white/80 p-5 shadow-sm transition hover:-translate-y-1 hover:border-slate-900/20 hover:shadow-lg" href="{{ route('courses.show', $course['slug']) }}" wire:key="public-course-{{ $course['id'] }}">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-start justify-between gap-2">
                            <h3 class="text-lg font-semibold text-slate-900">{{ $course['title'] }}</h3>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                {{ $course['videos_count'] }} ویدیو
                            </span>
                        </div>
                        @if (!empty($course['description']))
                            <p class="text-sm text-slate-600">{{ $course['description'] }}</p>
                        @endif
                        <span class="mt-auto text-xs font-medium uppercase tracking-[0.2em] text-amber-700">مشاهده صفحه دوره</span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>
