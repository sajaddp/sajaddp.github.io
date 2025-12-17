<?php

namespace App\Filament\Resources\Videos\Tables;

use App\VideoSource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('source')
                    ->label('منبع')
                    ->formatStateUsing(function (string|VideoSource|null $state): string {
                        if ($state instanceof VideoSource) {
                            return $state->getLabel();
                        }

                        return VideoSource::tryFrom((string) $state)?->getLabel() ?? (string) $state;
                    })
                    ->sortable(),
                TextColumn::make('course.title')
                    ->label('دوره')
                    ->sortable(),
                TextColumn::make('youtube_url')
                    ->label('آدرس ویدیو')
                    ->limit(40)
                    ->url(fn ($record) => $record->youtube_url, true),
                TextColumn::make('thumbnail_url')
                    ->label('تامبنیل')
                    ->limit(40)
                    ->url(fn ($record) => $record->thumbnail_url ?: null, true)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
