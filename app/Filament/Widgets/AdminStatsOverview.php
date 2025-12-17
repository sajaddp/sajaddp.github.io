<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Video;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $latestVideo = Video::query()->latest()->first();

        return [
            Stat::make('تعداد دوره ها', Course::query()->count())
                ->icon(Heroicon::OutlinedRectangleStack)
                ->color('primary'),
            Stat::make('تعداد ویدیوها', Video::query()->count())
                ->icon(Heroicon::OutlinedVideoCamera)
                ->color('primary'),
            Stat::make('آخرین ویدیو', $latestVideo?->title ?? 'بدون داده')
                ->description($latestVideo?->created_at?->diffForHumans() ?? 'هنوز ویدیویی ثبت نشده است')
                ->descriptionIcon(Heroicon::OutlinedClock),
        ];
    }
}
