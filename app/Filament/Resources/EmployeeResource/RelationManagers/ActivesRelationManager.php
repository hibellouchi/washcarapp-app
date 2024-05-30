<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivesRelationManager extends RelationManager
{
    protected static string $relationship = 'actives';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('active')
                    ->options([
                        'active' => 'Active',
                        'draft' => 'Non Active',
                    ])
                    ->native(false),
                    Forms\Components\TextInput::make('notes')
                ->maxLength(65535)

            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('active')
            ->columns([
                Tables\Columns\TextColumn::make('active')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'active' => 'success',
                    'draft' => 'danger',
                }),
                Tables\Columns\TextColumn::make('notes'),
                Tables\Columns\TextColumn::make('created_at')
                ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
