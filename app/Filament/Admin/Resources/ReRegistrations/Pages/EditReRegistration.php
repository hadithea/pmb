<?php

namespace App\Filament\Admin\Resources\ReRegistrations\Pages;

use App\Filament\Admin\Resources\ReRegistrations\ReRegistrationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReRegistration extends EditRecord
{
    protected static string $resource = ReRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
