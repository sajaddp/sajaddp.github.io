<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminStatsOverview;
use App\Filament\Widgets\LatestVideosTable;
use BackedEnum;
use Filament\Pages\Dashboard;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;

class AdminDashboard extends Dashboard
{
    protected static string $routePath = '/';

    protected static ?string $navigationLabel = 'داشبورد';

    protected static ?string $title = 'داشبورد';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            AdminStatsOverview::class,
            LatestVideosTable::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 1;
    }
}
