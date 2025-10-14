<?php

namespace App\Filament\Resources\Products\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\Operation;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Resources\Products\ProductResource;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    use CreateRecord\Concerns\HasWizard;
    protected function getSteps(): array
    {
        return [
            Step::make('Product info')
            ->description('Give the product name & description')
            ->schema([
            TextInput::make('name')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->readOnly()
                    ->hiddenOn(Operation::Create),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]),
            Step::make('Details')
            ->description('Give detailed information about the product')
            ->schema([
                    Select::make('category_id')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                    Select::make(name: 'supplier_id')
                        ->relationship('supplier', 'name')
                        ->searchable()
                        ->preload(),
                    TextInput::make('purchase_price')
                        ->required()
                        ->prefix('$')
                        ->numeric()
                        ->default(0),
                    TextInput::make('selling_price')
                        ->required()
                        ->prefix('$')
                        ->numeric()
                        ->default(0),
            ]),
            Step::make('Inventory')
            ->description('Set initial stock and other inventory details')
            ->schema([
                    TextInput::make('current_stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('minimum_stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('unit')
                    ->required()
                    ->default('pcs'),
                TextInput::make('barcode'),
            ]),
            Step::make('Media & status')
            ->description('Set initial stock and other inventory details')
            ->schema([
                   FileUpload::make('image')
                    ->image(),
                    Toggle::make('is_active')
                    ->required(),
            ])
        ];
    }
}
