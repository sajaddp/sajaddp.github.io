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
    <body class="min-h-screen bg-slate-50 text-right text-slate-950 antialiased">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(120%_120%_at_50%_0%,#fff7ed_0%,#f8fafc_45%,#ecfeff_100%)]"></div>
            <div class="pointer-events-none absolute -top-32 right-0 h-80 w-80 rounded-full bg-amber-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute left-0 top-24 h-72 w-72 rounded-full bg-cyan-200/40 blur-3xl"></div>

            <div class="relative mx-auto flex min-h-screen w-full max-w-5xl flex-col gap-10 px-6 py-12 lg:py-16">
                <header class="flex flex-col gap-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-sm font-semibold text-white">VA</span>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold uppercase tracking-[0.28em] text-amber-700">آکادمی ویدیو</span>
                                <span class="text-lg font-semibold text-slate-900">{{ config('app.name', 'Laravel') }}</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-900/10 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-900/20 hover:bg-white" href="{{ route('videos.index') }}">
                                همه ویدیوها
                                <span aria-hidden="true">&larr;</span>
                            </a>
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-900/10 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-900/20 hover:bg-white" href="{{ route('home') }}">
                                صفحه اصلی
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">جزئیات ویدیو</p>
                        <h1 class="text-3xl font-semibold text-slate-950 sm:text-4xl">{{ $video['title'] }}</h1>
                        @if (!empty($course))
                            <p class="text-sm text-slate-600">
                                مربوط به دوره:
                                <a class="font-semibold text-amber-700 hover:text-amber-800" href="{{ route('courses.show', $course['slug']) }}">
                                    {{ $course['title'] }}
                                </a>
                            </p>
                        @endif
                    </div>
                </header>

                <main class="flex flex-col gap-8">
                    <div class="rounded-3xl border border-slate-900/10 bg-white/80 p-4 shadow-lg">
                        @if (!empty($video['embed_url']))
                            <div class="aspect-video w-full overflow-hidden rounded-2xl bg-slate-200">
                                <iframe class="h-full w-full" src="{{ $video['embed_url'] }}" title="{{ $video['title'] }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center gap-3 rounded-2xl bg-slate-100 px-6 py-12 text-center">
                                <p class="text-sm font-medium text-slate-600">امکان نمایش مستقیم این ویدیو وجود ندارد.</p>
                                <a class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white" href="{{ $video['url'] }}" target="_blank" rel="noopener">
                                    مشاهده در منبع اصلی
                                    <span aria-hidden="true">&larr;</span>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col gap-6 rounded-3xl border border-slate-900/10 bg-white/70 p-6 shadow-sm">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-xl font-semibold text-slate-900">توضیحات و منابع</h2>
                            <p class="text-sm text-slate-500">جزئیات کامل و فایل های مرتبط با این ویدیو.</p>
                        </div>

                        @if (!empty($video['body']))
                            <div class="text-sm leading-relaxed text-slate-700 whitespace-pre-line">
                                {{ $video['body'] }}
                            </div>
                        @else
                            <p class="text-sm text-slate-500">برای این ویدیو متنی ثبت نشده است.</p>
                        @endif

                        @if (!empty($video['attachment_url']))
                            <a class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-4 py-2 text-sm font-semibold text-amber-900" href="{{ $video['attachment_url'] }}" target="_blank" rel="noopener">
                                دانلود فایل ضمیمه
                                <span aria-hidden="true">&darr;</span>
                            </a>
                        @endif
                    </div>
                </main>

                <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-900/10 pt-6 text-xs text-slate-500">
                    <span>ویدیو در تب جدید هم قابل مشاهده است.</span>
                    <a class="font-semibold text-amber-700" href="{{ $video['url'] }}" target="_blank" rel="noopener">مشاهده در منبع اصلی</a>
                </footer>
            </div>
        </div>
    </body>
</html>
