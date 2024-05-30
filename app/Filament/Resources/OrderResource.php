<?php

namespace App\Filament\Resources;

use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\Widgets\OrderTypeOverview;
use App\Models\Cars;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Filament\Forms\Components\Tabs;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Order Details')
                ->description('Put the Order details.')
                ->schema([

                Forms\Components\TextInput::make('orders_number')
                    ->default(state:'GF-' . random_int(100000, 999999))
                
                    ->required()
                    ->label('Order number'),
                Forms\Components\TextInput::make('notes')
                    ->maxLength(65535)
                    ->label('Notes'),
                Forms\Components\Select::make('customers_id')
                    ->relationship(name: 'customers', titleAttribute: 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->label('Full name'),
                        Forms\Components\TextInput::make('phone')
                        ->required()
                        ->tel()
                        ->label('Phone number'),
             ])
                    ->searchable()
                    ->required()
                    ->preload(),
                 Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',                       
                        'published' => 'Published',
                    ])
                    ->required()
                    ->native(false),
                    Forms\Components\TextInput::make('totalPayments')
                    ->prefix('DH')
                    ->live(),
                ])->columns(2),

                Forms\Components\Tabs::make('Label')
                ->tabs([
                    Tabs\Tab::make('Cars')
                        ->schema([
                            
                            Forms\Components\Repeater::make('orderItems')
                            
                            ->relationship('orderItems')
                            ->schema([
                                Forms\Components\Select::make('customers_id')
                                ->relationship(name: 'customers', titleAttribute: 'name')
                                ->required()
                                ->live()
                                //->afterStateUpdated(function (Set $set){$set ('cars_id', null ); } )
                                ->searchable()
                                ->preload(),
                                Forms\Components\Select::make('cars_id')
                                //->options(fn (Get $get): Collection => Cars::query()
                                   //->where('customers_id',$get('customers_id'))
                                    //->pluck('name','id'))
                                ->relationship('cars','name', fn (Builder $query, $get) => $query-> where('customers_id',$get('customers_id')) )
                                ->live()
                                ->required()
                                ->createOptionForm([
                                    
                                    Forms\Components\Select::make('customers_id')
                                    ->relationship(name: 'customers', titleAttribute: 'Customers.name')
                                    //->options(Customers::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->live()
                                    ->required()
                                    ->preload(),
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
                                    ])
                                ->searchable()
                                ->required()
                                ->preload(), 
                                
                                Forms\Components\Select::make('employee_id')
                                ->relationship(name: 'employee', titleAttribute: 'name')
                                ->required()
                                ->searchable()
                                ->preload(), 
                
                                Forms\Components\Select::make('service_id')
                                ->relationship(name: 'service', titleAttribute: 'name')
                                ->afterStateUpdated(function($state , callable $set){
                                    $service = Service::find($state);
                                    if($service){
                                        $set ('price', $service->price);
                                        
                                    }
                                })
                                ->live()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255)
                                        ->label('Service name'),
                                        Forms\Components\TextInput::make('price')
                                        ->numeric()
                                        ->prefix('DH')
                                        ->maxValue(42949672.95)
                                        ->label('Service price'),
                                    ])
                                ->searchable()
                                ->required()
                                ->preload(), 
                                Forms\Components\TextInput::make('price')
                                ->live()
                                ->numeric()
                                ->prefix('- DH'),
                                
                                Forms\Components\TextInput::make('total')
                                ->live()
                                ->numeric()
                                ->prefix('- DH'),
                                
                
                                Forms\Components\TextInput::make('Discount')  
                                ->live()
                                ->default(0)
                                ->numeric()
                                ->prefix('- DH')
                                ->maxValue(42949672.95),
                                Forms\Components\Placeholder::make('amount')    
                                ->live()   
                                                     
                                ->content(function ($get, $set) {                                
                                     $sum = $get('price')-$get('Discount') ;
                                     $set('total',$sum);
                                     
                                     return number_format($sum ,2) . "  DH" ;
                                    })
                                ])          
                                ->minItems(1)
                                ->columns(2)
                                ->columnSpan('full')

                        ])->columnSpan('full'),
                    ]),  

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Order $record): ?string => $record->created_at?->diffForHumans()),

                                    Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Order $record): ?string => $record->updated_at?->diffForHumans()),    
                                   
                                Forms\Components\Placeholder::make('payments_count')
                                    ->label('Total payments')
                                    ->content(fn (Order $record , $set) =>$set('totalPayments', $record->totalPayments()))
                            ]),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hiddenOn('create'),    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('status')
            ->columns([
                Tables\Columns\TextColumn::make('orders_number')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('notes'),
                Tables\Columns\TextColumn::make('customers.name')
                ->searchable(),
                Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'published' => 'success',
                    'draft' => 'danger',
                }),
                Tables\Columns\TextColumn::make('totalPayments')
                ->sortable()
                ->money('MAD')
                ->summarize(Sum::make()),
                
                Tables\Columns\TextColumn::make('created_at')
                ->sortable(),
            ])
            ->filters([
                Filter::make('status')
                ->query(fn (Builder $query) => $query->where('status', true)),
            SelectFilter::make('status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->native(false),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getWidgets(): array
    {
        return [
            
            OrderTypeOverview::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }    
}
