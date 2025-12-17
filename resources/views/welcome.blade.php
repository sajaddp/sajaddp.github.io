<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'fa' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        @if (!empty($jsonLd))
            <script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
            </script>
        @endif
    </head>
    <body class="min-h-screen bg-slate-50 text-right text-slate-950 antialiased">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(120%_120%_at_50%_0%,#fff7ed_0%,#f8fafc_45%,#ecfeff_100%)]"></div>
            <div class="pointer-events-none absolute -top-32 right-0 h-80 w-80 rounded-full bg-amber-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute left-0 top-24 h-72 w-72 rounded-full bg-cyan-200/40 blur-3xl"></div>

            <div class="relative mx-auto flex min-h-screen w-full max-w-6xl flex-col gap-14 px-6 py-12 lg:gap-16 lg:py-16">
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
                                مشاهده همه ویدیوها
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-900/10 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-900/20 hover:bg-white" href="{{ url('/admin') }}">
                                ورود به پنل
                                <span aria-hidden="true">&larr;</span>
                            </a>
                        </div>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
                        <div class="flex flex-col gap-4">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">دوره ها و ویدیوها</p>
                            <h1 class="text-4xl font-semibold leading-tight text-slate-950 sm:text-5xl">
                                با دقت آموزش بده، با سبک نمایش بده.
                            </h1>
                            <p class="max-w-2xl text-base text-slate-600">
                                دوره ها را مرتب کن، لینک های یوتیوب و تامبنیل ها را اضافه کن و یک نمایش مدرن برای صفحه اصلی بساز.
                            </p>
                        </div>
                        <div class="rounded-3xl border border-slate-900/10 bg-white/70 p-6 shadow-lg backdrop-blur">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">وضعیت</span>
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700">فعال</span>
                                </div>
                                <div class="text-2xl font-semibold text-slate-900">{{ count($courses) }} دوره</div>
                                <p class="text-sm text-slate-500">همه چیز را از پنل ادمین Filament مدیریت کن.</p>
                            </div>
                        </div>
                    </div>
                </header>

                @livewire('home-catalog', ['courses' => $courses])

                <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-900/10 pt-6 text-xs text-slate-500">
                    <span>مجموعه های ویدیویی برای یادگیرندگان.</span>
                    <span>ساخته شده با Laravel، Filament و Livewire.</span>
                </footer>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
