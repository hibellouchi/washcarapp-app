<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Filament\Resources\EmployeeResource\Widgets\EmployeeStatsOverview;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form

        
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Full name'),
                Forms\Components\TextInput::make('cin')
                ->required()
                ->maxLength(255)
                ->label('CIN'),
                Forms\Components\TextInput::make('phone')
                ->required()
                ->tel()
                ->label('Phone number'),
                Forms\Components\TextInput::make('email')
                ->email()
                ->maxLength(255)
                ->label('Email address'),

                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\Placeholder::make('created_at')
                                ->label('Created at')
                                ->content(fn (Employee $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                ->label('Updated at')
                                ->content(fn (Employee $record): ?string => $record->updated_at?->diffForHumans()),    
                               
                            Forms\Components\Placeholder::make('Employee_Salary ')
                                ->label('Employee Salary')
                                
                                ->content(fn (Employee $record ) => $record->totalPayments()),

                            Forms\Components\Placeholder::make('Employee_salary_avance')
                                ->label('Employee Salary Avance')
                                
                                ->content(fn (Employee $record ) => $record->salaryPayments()),

                            Forms\Components\Placeholder::make('Employee_salary_reste')
                                ->label('Employee Salary Reste')
                                
                                ->content(fn (Employee $record ) => $record->restPayments() )
                        ]),
                ])
                ->columnSpan(['lg' => 1])
                ->hiddenOn('create'),  

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('cin'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
                
                
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\ActivesRelationManager::class,
            RelationManagers\SalaryRelationManager::class,
            RelationManagers\OrderItemsRelationManager::class,
        ];
    }
    
    public static function getWidgets(): array
    {
        return [
            
            EmployeeStatsOverview::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
