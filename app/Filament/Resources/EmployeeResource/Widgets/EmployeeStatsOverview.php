<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Active;
use App\Models\Employee;
use App\Models\Salary;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmployeeStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Employees Salary',Salary::all()->pluck('price','id')->sum() . '  DH' )
            ->description('Paiements')
            ->color('danger'),

            Stat::make('All Employees',Employee::all()->count() ),
            
          
        ];
    }
}
