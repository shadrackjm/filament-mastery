<?php

namespace App\Filament\Resources\StockMovements\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\StockMovements\StockMovementResource;

class EditStockMovement extends EditRecord
{
    protected static string $resource = StockMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['notes'] = 'This is the initial notes of the stock movement';

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['notes'] = 'This is the final data that was transformed or changed';
        $record->update($data);

        return $record;
    }
        protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' =>$this->record->id]);
    }
}
