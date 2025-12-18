<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'fa' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - دوره ها</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen bg-slate-50 text-right text-slate-900 antialiased">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(120%_120%_at_50%_-10%,#fffaf5_0%,#f5fbff_45%,#eef2ff_100%)]"></div>
            <div class="pointer-events-none absolute -left-24 top-8 h-72 w-72 rounded-full bg-emerald-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute right-0 bottom-16 h-80 w-80 rounded-full bg-cyan-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute inset-x-10 top-20 h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>

            <div class="relative mx-auto flex min-h-screen w-full max-w-6xl flex-col gap-12 px-6 py-10 lg:gap-16 lg:py-14">
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

                    <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                        <div class="flex flex-col gap-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.32em] text-emerald-700">آرشیو کامل دوره ها</p>
                            <h1 class="text-4xl font-bold leading-tight text-slate-950 sm:text-5xl">کتابخانه مسیرهای یادگیری، آماده تماشا.</h1>
                            <p class="max-w-3xl text-sm leading-relaxed text-slate-600">سرفصل هر دوره، اپیزودهای مرتبط و دسترسی مستقیم به صفحه اختصاصی دوره‌ها را از همین صفحه دریافت کنید.</p>
                            <div class="flex flex-wrap items-center gap-3 pt-2">
                                <a class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-[0_10px_40px_rgba(16,185,129,0.4)] transition hover:-translate-y-0.5 hover:shadow-[0_12px_48px_rgba(16,185,129,0.5)]" href="{{ route('home') }}">
                                    بازگشت به خانه
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                                <a class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-700" href="{{ route('videos.index') }}">
                                    ورود به گالری ویدیوها
                                </a>
                            </div>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-xl">
                            <div class="flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">مرور سریع</span>
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold text-emerald-800 ring-1 ring-emerald-200">بدون لاگین</span>
                                </div>
                                <div class="flex items-center justify-between gap-3 rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-700">همه دوره ها</span>
                                        <span class="text-lg font-bold text-slate-900">مرتب شده بر اساس جدیدترین</span>
                                    </div>
                                    <span aria-hidden="true" class="text-xl text-emerald-700">&rarr;</span>
                                </div>
                                <p class="text-xs text-slate-600">برای مشاهده هر دوره و ویدیوهایش کافیست روی کارت های زیر کلیک کنی.</p>
                            </div>
                        </div>
                    </div>
                </header>

                @livewire('courses-index')

                <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 pt-6 text-xs text-slate-600">
                    <span>هر دوره صفحه اختصاصی خودش را دارد.</span>
                    <span>Laravel + Filament + Livewire</span>
                </footer>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
