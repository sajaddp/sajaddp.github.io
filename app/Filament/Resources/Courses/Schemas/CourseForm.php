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
                Section::make('Course details')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(160),
                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(4),
                    ])
                    ->columns(2),
            ]);
    }
}
