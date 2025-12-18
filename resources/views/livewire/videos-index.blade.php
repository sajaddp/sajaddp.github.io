<section class="flex flex-col gap-10">
    <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-semibold text-slate-950">همه ویدیوها</h2>
        <p class="text-sm text-slate-600">تمام ویدیوهای منتشر شده را یکجا ببین.</p>
    </div>

    @if (empty($videos))
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white/70 p-10 text-center text-sm text-slate-500">
            هنوز ویدیویی اضافه نشده است.
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($videos as $video)
                <a class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-900/10 bg-white/80 shadow-sm transition hover:-translate-y-1 hover:border-slate-900/20 hover:shadow-lg" href="{{ route('videos.show', $video['slug']) }}" wire:key="public-video-{{ $video['id'] }}">
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                        @if (!empty($video['thumbnail_url']))
                            <img class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]" src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }} thumbnail">
                        @else
                            <div class="flex h-full items-center justify-center text-sm font-medium text-slate-400">به زودی تامبنیل</div>
                        @endif
                    </div>
                    <div class="flex flex-1 flex-col gap-2 p-4">
                        <p class="text-base font-semibold text-slate-900">{{ $video['title'] }}</p>
                        @if (!empty($video['course']))
                            <a class="text-xs font-semibold text-amber-700 hover:text-amber-800" href="{{ route('courses.show', $video['course']['slug']) }}">
                                {{ $video['course']['title'] }}
                            </a>
                        @endif
                        <span class="mt-auto text-xs font-medium uppercase tracking-[0.2em] text-amber-700">مشاهده صفحه ویدیو</span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>
