<?php

namespace App\Filament\Admin\Resources\SelectionResults\Pages;

use App\Filament\Admin\Resources\SelectionResults\SelectionResultResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSelectionResults extends ListRecords
{
    protected static string $resource = SelectionResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
