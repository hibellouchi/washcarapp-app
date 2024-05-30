<?php

namespace App\Livewire;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Order;

use Filament\Widgets\ChartWidget;

class OrderItemsChart extends ChartWidget
{
    protected static ?string $heading = 'Orders Chart';
    protected static string $color = 'info';

    protected function getData(): array
    {
        $data = Trend::model(Order::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();
 
    return [
        'datasets' => [
            [
                'label' => 'Order',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
