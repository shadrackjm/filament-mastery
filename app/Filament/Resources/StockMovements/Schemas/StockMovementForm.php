<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->relationship('product','name')
                    ->searchable()
                    ->preload()
                    ->required(),
                // Select::make('user_id')
                //     ->relationship('user','name')
                //     ->searchable()
                //     ->preload()
                //     ->required(),
                ToggleButtons::make('type')
                    ->grouped()
                    ->options(['in' => 'In', 'out' => 'Out'])
                    ->colors([
                        'in'=> 'success',
                        'out'=> 'danger',
                    ])
                    ->required(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('previous_stock')
                    ->required()
                    ->numeric(),
                TextInput::make('new_stock')
                    ->required()
                    ->numeric(),
                Textarea::make('reason')
                ->rows(3)
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    
                    ->columnSpanFull(),
                DateTimePicker::make('movement_date')
                    ->required()
                    ->default(now()),
            ]);
    }
}
