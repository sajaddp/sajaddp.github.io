<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum VideoSource: string implements HasLabel
{
    case Youtube = 'youtube';
    case Aparat = 'aparat';
    case Other = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::Youtube => 'یوتیوب',
            self::Aparat => 'آپارات',
            self::Other => 'سایر',
        };
    }
}
