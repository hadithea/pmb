<?php

namespace App\Filament\Admin\Resources\SelectionResults\Pages;

use App\Filament\Admin\Resources\SelectionResults\SelectionResultResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSelectionResult extends EditRecord
{
    protected static string $resource = SelectionResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
