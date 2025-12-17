<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Videos\VideoResource;
use App\Models\Video;
use App\VideoSource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestVideosTable extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Video::query()->with('course')->latest()->limit(8))
            ->columns([
                TextColumn::make('title')
                    ->label('عنوان')
                    ->limit(40)
                    ->searchable(),
                TextColumn::make('source')
                    ->label('منبع')
                    ->formatStateUsing(function (string|VideoSource|null $state): string {
                        if ($state instanceof VideoSource) {
                            return $state->getLabel();
                        }

                        return VideoSource::tryFrom((string) $state)?->getLabel() ?? (string) $state;
                    }),
                TextColumn::make('course.title')
                    ->label('دوره')
                    ->limit(30),
                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime(),
            ])
            ->recordUrl(fn (Video $record): string => VideoResource::getUrl('edit', ['record' => $record]));
    }
}
