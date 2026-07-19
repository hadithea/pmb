<?php

namespace App\Filament\Admin\Resources\SelectionPaths\Pages;

use App\Filament\Admin\Resources\SelectionPaths\SelectionPathResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSelectionPaths extends ListRecords
{
    protected static string $resource = SelectionPathResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
