<?php

namespace App\Filament\Resources\Videos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Video details')
                    ->schema([
                        Select::make('course_id')
                            ->label('Course')
                            ->relationship('course', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(160),
                        TextInput::make('youtube_url')
                            ->label('YouTube URL')
                            ->required()
                            ->url()
                            ->maxLength(255),
                        TextInput::make('thumbnail_url')
                            ->label('Thumbnail URL')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }
}
