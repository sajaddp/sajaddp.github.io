<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'fa' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - {{ $video['title'] }}</title>

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

            <div class="relative mx-auto flex min-h-screen w-full max-w-5xl flex-col gap-10 px-6 py-10 lg:py-14">
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

                    <div class="flex flex-col gap-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-emerald-700">جزئیات ویدیو</p>
                        <h1 class="text-3xl font-bold text-slate-950 sm:text-4xl">{{ $video['title'] }}</h1>
                        @if (!empty($course))
                            <p class="text-sm text-slate-600">
                                مربوط به دوره:
                                <a class="font-semibold text-emerald-700 transition hover:text-emerald-800" href="{{ route('courses.show', $course['slug']) }}">
                                    {{ $course['title'] }}
                                </a>
                            </p>
                        @endif
                    </div>
                </header>

                <main class="flex flex-col gap-8">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-lg">
                        @if (!empty($video['embed_url']))
                            <div class="aspect-video w-full overflow-hidden rounded-2xl bg-slate-100 ring-1 ring-slate-200">
                                <iframe class="h-full w-full" src="{{ $video['embed_url'] }}" title="{{ $video['title'] }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center gap-3 rounded-2xl bg-slate-50 px-6 py-12 text-center ring-1 ring-slate-200">
                                <p class="text-sm font-medium text-slate-700">امکان نمایش مستقیم این ویدیو وجود ندارد.</p>
                                <a class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-sm font-bold text-white shadow-[0_10px_40px_rgba(16,185,129,0.4)] transition hover:-translate-y-0.5 hover:shadow-[0_12px_48px_rgba(16,185,129,0.5)]" href="{{ $video['url'] }}" target="_blank" rel="noopener">
                                    مشاهده در منبع اصلی
                                    <span aria-hidden="true">&larr;</span>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col gap-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-lg">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-xl font-bold text-slate-900">توضیحات و منابع</h2>
                            <p class="text-xs text-slate-600">جزئیات کامل و فایل های مرتبط با این ویدیو.</p>
                        </div>

                        @if (!empty($video['body']))
                            <div class="whitespace-pre-line text-sm leading-relaxed text-slate-700">
                                {{ $video['body'] }}
                            </div>
                        @else
                            <p class="text-sm text-slate-500">برای این ویدیو متنی ثبت نشده است.</p>
                        @endif

                        @if (!empty($video['attachment_url']))
                            <a class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-800 transition hover:border-emerald-300 hover:bg-emerald-100" href="{{ $video['attachment_url'] }}" target="_blank" rel="noopener">
                                دانلود فایل ضمیمه
                                <span aria-hidden="true">&darr;</span>
                            </a>
                        @endif
                    </div>
                </main>

                <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 pt-6 text-xs text-slate-600">
                    <span>ویدیو در تب جدید هم قابل مشاهده است.</span>
                    <a class="font-semibold text-emerald-700" href="{{ $video['url'] }}" target="_blank" rel="noopener">مشاهده در منبع اصلی</a>
                </footer>
            </div>
        </div>
    </body>
</html>
