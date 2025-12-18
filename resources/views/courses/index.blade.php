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
    <body class="min-h-screen bg-slate-50 text-right text-slate-950 antialiased">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(120%_120%_at_50%_0%,#fff7ed_0%,#f8fafc_45%,#ecfeff_100%)]"></div>
            <div class="pointer-events-none absolute -top-32 right-0 h-80 w-80 rounded-full bg-amber-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute left-0 top-24 h-72 w-72 rounded-full bg-cyan-200/40 blur-3xl"></div>

            <div class="relative mx-auto flex min-h-screen w-full max-w-6xl flex-col gap-12 px-6 py-12 lg:gap-16 lg:py-16">
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
                                بازگشت به خانه
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">آرشیو کامل دوره ها</p>
                        <h1 class="text-4xl font-semibold leading-tight text-slate-950 sm:text-5xl">لیست دوره ها</h1>
                        <p class="max-w-2xl text-base text-slate-600">تمام دوره ها را مرور کن و وارد صفحه اختصاصی هر دوره شو.</p>
                    </div>
                </header>

                @livewire('courses-index')

                <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-900/10 pt-6 text-xs text-slate-500">
                    <span>هر دوره صفحه اختصاصی خودش را دارد.</span>
                    <span>Laravel + Filament + Livewire</span>
                </footer>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
