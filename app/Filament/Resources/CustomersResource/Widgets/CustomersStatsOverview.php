<?php

namespace App\Filament\Resources\CustomersResource\Widgets;

use App\Models\Customers;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomersStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('All Customers',Customers::all()->count() )

        ];
    }
}
