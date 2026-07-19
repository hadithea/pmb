<?php

namespace App\Filament\Admin\Resources\ReRegistrations\Pages;

use App\Filament\Admin\Resources\ReRegistrations\ReRegistrationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReRegistrations extends ListRecords
{
    protected static string $resource = ReRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
