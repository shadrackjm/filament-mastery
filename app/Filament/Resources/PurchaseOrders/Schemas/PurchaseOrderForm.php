<?php

namespace App\Filament\Resources\PurchaseOrders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;

class PurchaseOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                Select::make('supplier_id')
                    ->relationship('supplier','name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('user_id')
                    ->relationship('user','name')
                    ->preload()
                    ->searchable()
                    ->required(),
                ToggleButtons::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'ordered' => 'Ordered',
                        'received' => 'Received',
                        'cancelled' => 'Cancelled',
                    ])
                    ->colors([
                        'pending' => 'secondary',
                        'ordered' => 'info',
                        'received' => 'success',
                        'cancelled' => 'danger',
                    ])
                    ->grouped()
                    ->default('pending')
                    ->required(),
                DatePicker::make('order_date')
                    ->required(),
                DatePicker::make('expected_date'),
                DatePicker::make('received_date'),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
