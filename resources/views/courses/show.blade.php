<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'fa' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - {{ $course['title'] }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 text-right text-slate-900 antialiased">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(120%_120%_at_50%_-10%,#fffaf5_0%,#f5fbff_45%,#eef2ff_100%)]"></div>
            <div class="pointer-events-none absolute -left-24 top-8 h-72 w-72 rounded-full bg-emerald-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute right-0 bottom-16 h-80 w-80 rounded-full bg-cyan-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute inset-x-10 top-20 h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>

            <div class="relative mx-auto flex min-h-screen w-full max-w-6xl flex-col gap-12 px-6 py-10 lg:py-14">
                <header class="flex flex-col gap-8">
                    <nav class="flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white/90 px-5 py-3 shadow-lg backdrop-blur">
                        <div class="flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500 text-base font-black text-white">VA</span>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold uppercase tracking-[0.32em] text-emerald-700">Video Academy</span>
                                <span class="text-lg font-semibold text-slate-900">{{ config('app.name', 'Laravel') }}</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-700" href="{{ route('home') }}">
                                صفحه اصلی
                                <span aria-hidden="true">&larr;</span>
                            </a>
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-700" href="{{ route('videos.index') }}">
                                همه ویدیوها
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-sm font-bold text-white shadow-[0_8px_30px_rgba(16,185,129,0.35)] transition hover:-translate-y-0.5 hover:shadow-[0_10px_40px_rgba(16,185,129,0.5)]" href="{{ url('/admin') }}">
                                ورود به پنل
                                <span aria-hidden="true">&larr;</span>
                            </a>
                        </div>
                    </nav>

                    <div class="flex flex-col gap-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-emerald-700">صفحه دوره</p>
                        <h1 class="text-3xl font-bold text-slate-950 sm:text-4xl">{{ $course['title'] }}</h1>
                        @if (!empty($course['description']))
                            <p class="max-w-3xl text-sm leading-relaxed text-slate-600">{{ $course['description'] }}</p>
                        @endif
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-emerald-700 ring-1 ring-emerald-200">
                                {{ count($videos) }} ویدیو
                            </span>
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-700 ring-1 ring-slate-200">
                                بدون لاگین
                            </span>
                        </div>
                    </div>
                </header>

                <main class="flex flex-col gap-10">
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-xl font-bold text-slate-900">متن دوره</h2>
                            <p class="text-xs text-slate-600">اطلاعات تکمیلی و توضیحات دوره.</p>
                        </div>
                        @if (!empty($course['body']))
                            <div class="mt-4 whitespace-pre-line text-sm leading-relaxed text-slate-700">
                                {{ $course['body'] }}
                            </div>
                        @else
                            <p class="mt-4 text-sm text-slate-500">برای این دوره متنی ثبت نشده است.</p>
                        @endif
                    </section>

                    <section class="flex flex-col gap-6">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex flex-col">
                                <h2 class="text-xl font-bold text-slate-900">ویدیوهای دوره</h2>
                                <p class="text-xs text-slate-600">هر ویدیو صفحه اختصاصی خودش را دارد؛ مشابه تجربه Laracasts.</p>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-700 ring-1 ring-slate-200">
                                {{ count($videos) }} ویدیو
                            </span>
                        </div>

                        @if (empty($videos))
                            <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-10 text-center text-sm text-slate-500">
                                هنوز ویدیویی برای این دوره ثبت نشده است.
                            </div>
                        @else
                            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($videos as $video)
                                    <a class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:border-emerald-200 hover:shadow-lg" href="{{ route('videos.show', $video['slug']) }}">
                                        <div class="relative aspect-video w-full overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
                                            @if (!empty($video['thumbnail_url']))
                                                <img class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]" src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }} thumbnail">
                                            @else
                                                <div class="flex h-full items-center justify-center text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Preview</div>
                                            @endif
                                            <span class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.16em] text-slate-900 ring-1 ring-slate-200">Episode</span>
                                        </div>
                                        <div class="flex flex-1 flex-col gap-2 p-4">
                                            <p class="text-base font-semibold text-slate-900">{{ $video['title'] }}</p>
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
                </main>

                <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 pt-6 text-xs text-slate-600">
                    <span>هر ویدیو صفحه اختصاصی خودش را دارد.</span>
                    <a class="font-semibold text-emerald-700" href="{{ route('videos.index') }}">مشاهده همه ویدیوها</a>
                </footer>
            </div>
        </div>
    </body>
</html>
