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
    <body class="min-h-screen bg-slate-50 text-right text-slate-950 antialiased">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(120%_120%_at_50%_0%,#fff7ed_0%,#f8fafc_45%,#ecfeff_100%)]"></div>
            <div class="pointer-events-none absolute -top-32 right-0 h-80 w-80 rounded-full bg-amber-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute left-0 top-24 h-72 w-72 rounded-full bg-cyan-200/40 blur-3xl"></div>

            <div class="relative mx-auto flex min-h-screen w-full max-w-6xl flex-col gap-12 px-6 py-12 lg:py-16">
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

                    <div class="flex flex-col gap-4">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">صفحه دوره</p>
                        <h1 class="text-3xl font-semibold text-slate-950 sm:text-4xl">{{ $course['title'] }}</h1>
                        @if (!empty($course['description']))
                            <p class="max-w-3xl text-base text-slate-600">{{ $course['description'] }}</p>
                        @endif
                    </div>
                </header>

                <main class="flex flex-col gap-10">
                    <section class="rounded-3xl border border-slate-900/10 bg-white/70 p-6 shadow-sm">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-xl font-semibold text-slate-900">متن دوره</h2>
                            <p class="text-sm text-slate-500">اطلاعات تکمیلی و توضیحات دوره.</p>
                        </div>
                        @if (!empty($course['body']))
                            <div class="mt-4 text-sm leading-relaxed text-slate-700 whitespace-pre-line">
                                {{ $course['body'] }}
                            </div>
                        @else
                            <p class="mt-4 text-sm text-slate-500">برای این دوره متنی ثبت نشده است.</p>
                        @endif
                    </section>

                    <section class="flex flex-col gap-6">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="text-xl font-semibold text-slate-900">ویدیوهای دوره</h2>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                {{ count($videos) }} ویدیو
                            </span>
                        </div>

                        @if (empty($videos))
                            <div class="rounded-3xl border border-dashed border-slate-300 bg-white/70 p-10 text-center text-sm text-slate-500">
                                هنوز ویدیویی برای این دوره ثبت نشده است.
                            </div>
                        @else
                            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($videos as $video)
                                    <a class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-900/10 bg-white/80 shadow-sm transition hover:-translate-y-1 hover:border-slate-900/20 hover:shadow-lg" href="{{ route('videos.show', $video['id']) }}">
                                        <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                                            @if (!empty($video['thumbnail_url']))
                                                <img class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]" src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }} thumbnail">
                                            @else
                                                <div class="flex h-full items-center justify-center text-sm font-medium text-slate-400">به زودی تامبنیل</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-1 flex-col gap-2 p-4">
                                            <p class="text-base font-semibold text-slate-900">{{ $video['title'] }}</p>
                                            <span class="text-xs font-medium uppercase tracking-[0.2em] text-amber-700">مشاهده صفحه ویدیو</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </section>
                </main>

                <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-900/10 pt-6 text-xs text-slate-500">
                    <span>هر ویدیو صفحه اختصاصی خودش را دارد.</span>
                    <a class="font-semibold text-amber-700" href="{{ route('videos.index') }}">مشاهده همه ویدیوها</a>
                </footer>
            </div>
        </div>
    </body>
</html>
