<?php

namespace App\Filament\Resources\Videos\Schemas;

use App\VideoSource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('جزئیات ویدیو')
                    ->schema([
                        Select::make('source')
                            ->label('منبع')
                            ->options(VideoSource::class)
                            ->default(VideoSource::Youtube)
                            ->required(),
                        Select::make('course_id')
                            ->label('دوره')
                            ->relationship('course', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('title')
                            ->label('عنوان')
                            ->required()
                            ->maxLength(160),
                        TextInput::make('youtube_url')
                            ->label('آدرس ویدیو')
                            ->helperText('لینک یوتیوب، آپارات یا سایر منابع را وارد کنید.')
                            ->required()
                            ->url()
                            ->maxLength(255),
                        TextInput::make('thumbnail_url')
                            ->label('آدرس تامبنیل')
                            ->url()
                            ->maxLength(255),
                        Textarea::make('body')
                            ->label('متن پایین ویدیو')
                            ->columnSpanFull()
                            ->rows(6),
                        FileUpload::make('attachment_path')
                            ->label('فایل ضمیمه')
                            ->disk('public')
                            ->directory('videos/attachments')
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
