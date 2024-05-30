<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Filament\Resources\EmployeeResource\RelationManagers\ActivesRelationManager;
use App\Filament\Resources\EmployeeResource\Widgets\EmployeeStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            EmployeeStatsOverview::class,
        ];
    }

}
