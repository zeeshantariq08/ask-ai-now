<?php

namespace App\Filament\Pages;
use App\Filament\Widgets\AIAssistant;
use Filament\Panel;

class Dashboard extends \Filament\Pages\Dashboard
{


    public function getWidgets(): array
    {
        return [
            AIAssistant::class,
        ];
    }

}
