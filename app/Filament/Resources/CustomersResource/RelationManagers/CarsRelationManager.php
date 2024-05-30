<?php

namespace App\Filament\Resources\CustomersResource\RelationManagers;

use App\Models\Brands;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarsRelationManager extends RelationManager
{ 
    protected static string $relationship = 'cars';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('name')
                ->options([
                    'Abarth' => 'Abarth',
                    'AlfaRomeo' => 'AlfaRomeo',
                    'AstonMartin' => 'AstonMartin',
                    'Audi' => 'Audi',
                    'Bentley' => 'Bentley',
                    'BMW' => 'BMW',
                    'Bugatti' => 'Bugatti',
                    'Cadillac' => 'Cadillac',
                    'Chevrolet' => 'Chevrolet',
                    'Chrysler' => 'Chrysler',
                    'Citroën' => 'Citroën',
                    'Dacia' => 'Dacia',
                    'Daewoo' => 'Daewoo',
                    'Daihatsu' => 'Daihatsu',
                    'Dodge' => 'Dodge',
                    'Donkervoort' => 'Donkervoort',
                    'DS' => 'DS',
                    'Ferrari' => 'Ferrari',
                    'Fiat' => 'Fiat',
                    'Fisker' => 'Fisker',
                    'Ford' => 'Ford',
                    'Honda' => 'Honda',
                    'Hummer' => 'Hummer',
                    'Hyundai' => 'Hyundai',
                    'Infiniti' => 'Infiniti',
                    'Iveco' => 'Iveco',
                    'Jaguar' => 'Jaguar',
                    'Jeep' => 'Jeep',
                    'Kia' => 'Kia',
                    'KTM' => 'KTM',
                    'Lada' => 'Lada',
                    'Lamborghini' => 'Lamborghini',
                    'Lancia' => 'Lancia',
                    'LandRover' => 'LandRover',
                    'Landwind' => 'Landwind',
                    'Lexus' => 'Lexus',
                    'Lotus' => 'Lotus',
                    'Maserati' => 'Maserati',
                    'Maybach' => 'Maybach',
                    'Mazda' => 'Mazda',
                    'McLaren' => 'McLaren',
                    'Mercedes-Benz' => 'Mercedes-Benz',
                    'MG' => 'MG',
                    'Mini' => 'Mini',
                    'Mitsubishi' => 'Mitsubishi',
                    'Morgan' => 'Morgan',
                    'Nissan' => 'Nissan',
                    'Opel' => 'Opel',
                    'Peugeot' => 'Peugeot',
                    'Porsche' => 'Porsche',
                    'Renault' => 'Renault',
                    'Rolls-Royce' => 'Rolls-Royce',
                    'Rover' => 'Rover',
                    'Saab' => 'Saab',
                    'Seat' => 'Seat',
                    'Skoda' => 'Skoda',
                    'Smart' => 'Smart',
                    'SsangYong' => 'SsangYong',
                    'Subaru' => 'Subaru',
                    'Suzuki' => 'Suzuki',
                    'Tesla' => 'Tesla',
                    'Toyota' => 'Toyota',
                    'Volkswagen' => 'Volkswagen',
                    'Volvo' => 'Volvo',

                ])
                ->required()
                ->searchable()
                ->label('Brand'),
                Forms\Components\TextInput::make('models')
                ->datalist([])
                ->maxLength(255)
                ->label('Model'),
                Forms\Components\TextInput::make('matricul')
                ->maxLength(255)
                ->label('Matricul')
                ->columnSpan('full'),
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('brands')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('models'),
                Tables\Columns\TextColumn::make('matricul')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
