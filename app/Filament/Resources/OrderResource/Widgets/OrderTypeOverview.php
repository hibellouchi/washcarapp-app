<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderTypeOverview extends BaseWidget
{
    protected function getStats(): array 
    {
        return [
            Stat::make('Revenable',Order::query()->where('status', 'published')->pluck('totalPayments','id')->sum() . '  DH' )
            ->description('increase')
            ->color('success')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Revenable',Order::query()->where('status', 'draft')->pluck('totalPayments','id')->sum() . '  DH' )
            ->description('increase')
            ->color('danger')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('All Order',Order::all()->count() ),

        ];
    }
}
