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
    <body class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100 text-right text-slate-900 antialiased">
        @php
            $totalVideos = collect($courses)->sum(fn (array $course): int => count($course['videos']));
            $highlightVideos = collect($courses)
                ->flatMap(fn (array $course): array => $course['videos'])
                ->take(4);
        @endphp

        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(120%_120%_at_50%_-10%,#fef7ed_0%,#f3f8ff_40%,#eef2ff_100%)]"></div>
            <div class="pointer-events-none absolute -left-24 top-8 h-72 w-72 rounded-full bg-emerald-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute -right-16 bottom-20 h-80 w-80 rounded-full bg-cyan-200/40 blur-3xl"></div>

            <div class="relative mx-auto flex min-h-screen w-full max-w-6xl flex-col gap-14 px-6 py-10 lg:py-14">
                <header class="flex flex-col gap-10">
                    <nav class="flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white/90 px-6 py-4 shadow-2xl backdrop-blur">
                        <div class="flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500 text-base font-black text-white">VA</span>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold uppercase tracking-[0.32em] text-emerald-700">Video Academy</span>
                                <span class="text-lg font-semibold text-slate-900">{{ config('app.name', 'Laravel') }}</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-700" href="{{ route('courses.index') }}">
                                دوره ها
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-700" href="{{ route('videos.index') }}">
                                ویدیوها
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-sm font-bold text-white shadow-[0_10px_40px_rgba(16,185,129,0.35)] transition hover:-translate-y-0.5 hover:shadow-[0_12px_48px_rgba(16,185,129,0.45)]" href="{{ url('/admin') }}">
                                ورود به پنل
                                <span aria-hidden="true">&larr;</span>
                            </a>
                        </div>
                    </nav>

                    <div class="grid gap-10 lg:grid-cols-12 lg:items-center">
                        <div class="flex flex-col gap-6 lg:col-span-7">
                            <div class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">
                                کیفیت در حد Laracasts
                                <span class="h-1 w-1 rounded-full bg-emerald-500"></span>
                                دسترسی آزاد
                            </div>
                            <h1 class="text-4xl font-bold leading-tight text-slate-950 sm:text-5xl">
                                آموزش‌های ویدیویی Laravel و PHP با نگاه حرفه‌ای به تجربه کاربر.
                            </h1>
                            <p class="max-w-3xl text-base leading-relaxed text-slate-600">
                                مسیرهای یادگیری منظم، تولید محتوای دقیق و صفحه‌های اختصاصی برای هر ویدیو و دوره. همه چیز بدون نیاز به ثبت‌نام در دسترس است؛ کافیست انتخاب کنید و تماشا کنید.
                            </p>
                            <div class="grid gap-3 text-sm text-slate-700 sm:grid-cols-2">
                                <div class="flex items-center gap-2 rounded-xl bg-white px-3 py-2 ring-1 ring-slate-200">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    آخرین انتشارها همیشه در دسترس و مرتب
                                </div>
                                <div class="flex items-center gap-2 rounded-xl bg-white px-3 py-2 ring-1 ring-slate-200">
                                    <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
                                    رابط روشن، مینیمال و مناسب مشاهده طولانی
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <a class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-[0_12px_45px_rgba(16,185,129,0.4)] transition hover:-translate-y-0.5 hover:shadow-[0_14px_55px_rgba(16,185,129,0.45)]" href="{{ route('courses.index') }}">
                                    شروع مسیر یادگیری
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                                <a class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-700" href="{{ route('videos.index') }}">
                                    مرور آخرین ویدیوها
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </div>

                        <div class="lg:col-span-5">
                            <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-2xl backdrop-blur">
                                <div class="pointer-events-none absolute -left-10 top-0 h-56 w-56 rounded-full bg-emerald-200/60 blur-3xl"></div>
                                <div class="pointer-events-none absolute bottom-0 right-0 h-40 w-40 rounded-full bg-cyan-200/60 blur-3xl"></div>
                                <div class="relative flex flex-col gap-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2 text-xs font-semibold text-emerald-700">
                                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                            پخش فوری
                                        </div>
                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold text-emerald-800 ring-1 ring-emerald-200">بدون لاگین</span>
                                    </div>
                                    <div class="text-2xl font-bold text-slate-900">+{{ $totalVideos }} ویدیو</div>
                                    <p class="text-sm text-slate-600">پخش مستقیم از YouTube و آپارات؛ از موبایل تا دسکتاپ با کیفیت یکنواخت.</p>
                                    <dl class="grid grid-cols-3 gap-3 text-center text-xs">
                                        <div class="rounded-xl bg-emerald-50 px-3 py-2 ring-1 ring-emerald-200">
                                            <dt class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-700">دوره ها</dt>
                                            <dd class="text-lg font-bold text-slate-900">{{ count($courses) }}</dd>
                                        </div>
                                        <div class="rounded-xl bg-cyan-50 px-3 py-2 ring-1 ring-cyan-200">
                                            <dt class="text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-700">ویدیوها</dt>
                                            <dd class="text-lg font-bold text-slate-900">{{ $totalVideos }}</dd>
                                        </div>
                                        <div class="rounded-xl bg-amber-50 px-3 py-2 ring-1 ring-amber-200">
                                            <dt class="text-[11px] font-semibold uppercase tracking-[0.18em] text-amber-700">بروزرسانی</dt>
                                            <dd class="text-lg font-bold text-slate-900">هفتگی</dd>
                                        </div>
                                    </dl>
                                    <div class="flex flex-col gap-3 rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200">
                                        <div class="flex items-center justify-between text-xs font-semibold text-slate-700">
                                            <span>جدیدترین انتشارها</span>
                                            <span class="text-emerald-700">به‌روز</span>
                                        </div>
                                        <div class="flex flex-col divide-y divide-slate-200 text-sm text-slate-900">
                                            @forelse ($highlightVideos as $video)
                                                <div class="flex items-center justify-between gap-3 py-2">
                                                    <span class="line-clamp-1">{{ $video['title'] }}</span>
                                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-emerald-700 ring-1 ring-emerald-200">
                                                        {{ $video['source'] === 'aparat' ? 'Aparat' : 'YouTube' }}
                                                    </span>
                                                </div>
                                            @empty
                                                <span class="py-2 text-xs text-slate-500">هنوز ویدیویی ثبت نشده است.</span>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                @livewire('home-catalog', ['courses' => $courses])

                <section class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-xl">
                    <div class="flex flex-col gap-3">
                        <p class="text-sm font-semibold uppercase tracking-[0.32em] text-emerald-700">همراه تیم فنی بمان</p>
                        <h2 class="text-3xl font-bold text-slate-900">برنامه‌ریزی کن، منتشر کن و تجربه‌ای هم‌سطح Laracasts بساز.</h2>
                        <p class="mx-auto max-w-3xl text-sm leading-relaxed text-slate-600">
                            مسیرهای یادگیری، جزئیات هر ویدیو و مدیریت فایل‌ها را از پنل ادمین کنترل کن. کاربران بدون لاگین هم تجربه‌ای حرفه‌ای خواهند داشت.
                        </p>
                        <div class="flex flex-wrap justify-center gap-3 pt-2">
                            <a class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-[0_12px_45px_rgba(16,185,129,0.4)] transition hover:-translate-y-0.5 hover:shadow-[0_14px_55px_rgba(16,185,129,0.45)]" href="{{ route('courses.index') }}">
                                نگاهی به دوره ها
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-700" href="{{ route('videos.index') }}">
                                لیست کامل ویدیوها
                            </a>
                        </div>
                    </div>
                </section>

                <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 pt-6 text-xs text-slate-600">
                    <span>مجموعه‌ای برای یادگیری بدون مرز و بدون لاگین.</span>
                    <span>ساخته شده با Laravel، Filament و Livewire.</span>
                </footer>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
