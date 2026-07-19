<?php

namespace App\Filament\Admin\Resources\RegistrationHistories\Pages;

use App\Filament\Admin\Resources\RegistrationHistories\RegistrationHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRegistrationHistories extends ListRecords
{
    protected static string $resource = RegistrationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
