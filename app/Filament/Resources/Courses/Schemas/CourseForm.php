<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('جزئیات دوره')
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان')
                            ->required()
                            ->maxLength(160),
                        Textarea::make('description')
                            ->label('توضیحات')
                            ->columnSpanFull()
                            ->rows(4),
                        Textarea::make('body')
                            ->label('متن صفحه')
                            ->columnSpanFull()
                            ->rows(8),
                    ])
                    ->columns(2),
            ]);
    }
}
