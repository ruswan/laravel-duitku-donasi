<?php

namespace App\Filament\Widgets;

use App\Models\Campaign;
use App\Models\Donasi;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DashboardWidgets extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::count()),
            Card::make('Total Campaigns', Campaign::count()),
            Card::make('Total Donasis', Donasi::whereNotNull('paid')->count()),
        ];
    }
}
