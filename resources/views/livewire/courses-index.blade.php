<section class="flex flex-col gap-12">
    <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold text-slate-900">همه دوره ها</h2>
        <p class="text-sm text-slate-600">فهرست کامل دوره ها را ببین و وارد صفحه هر دوره شو.</p>
    </div>

    @if (empty($courses))
        <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-10 text-center text-sm text-slate-500">
            هنوز دوره ای اضافه نشده است.
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($courses as $course)
                <a class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-xl transition hover:-translate-y-1 hover:border-emerald-200 hover:shadow-2xl" href="{{ route('courses.show', $course['slug']) }}" wire:key="public-course-{{ $course['id'] }}">
                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-50 via-transparent to-white opacity-0 transition duration-300 group-hover:opacity-100"></div>
                    <div class="relative flex flex-col gap-4">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex flex-col gap-1">
                                <h3 class="text-lg font-bold text-slate-900">{{ $course['title'] }}</h3>
                                @if (!empty($course['description']))
                                    <p class="text-sm leading-relaxed text-slate-600 line-clamp-2">{{ $course['description'] }}</p>
                                @endif
                            </div>
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-700 ring-1 ring-emerald-200">
                                {{ $course['videos_count'] }} ویدیو
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-slate-600">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            آپدیت‌های مستمر ویدیویی
                        </div>
                        <span class="mt-auto inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-800 ring-1 ring-emerald-200">
                            مشاهده صفحه دوره
                            <span aria-hidden="true">&rarr;</span>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>
