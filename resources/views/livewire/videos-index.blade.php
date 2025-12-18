<section class="flex flex-col gap-10">
    <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold text-slate-900">همه ویدیوها</h2>
        <p class="text-sm text-slate-600">تمام ویدیوهای منتشر شده را یکجا ببین.</p>
    </div>

    @if (empty($videos))
        <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-10 text-center text-sm text-slate-500">
            هنوز ویدیویی اضافه نشده است.
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($videos as $video)
                <a class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:border-cyan-200 hover:shadow-lg" href="{{ route('videos.show', $video['slug']) }}" wire:key="public-video-{{ $video['id'] }}">
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
                        <span class="mt-auto inline-flex w-fit items-center gap-2 rounded-full bg-cyan-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-800 ring-1 ring-cyan-200">
                            صفحه ویدیو
                            <span aria-hidden="true">&rarr;</span>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>
