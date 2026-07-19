<?php

namespace App\Filament\Admin\Resources\SelectionPaths\Pages;

use App\Filament\Admin\Resources\SelectionPaths\SelectionPathResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSelectionPath extends EditRecord
{
    protected static string $resource = SelectionPathResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
