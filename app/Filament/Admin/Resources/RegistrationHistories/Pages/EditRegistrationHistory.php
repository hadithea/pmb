<?php

namespace App\Filament\Admin\Resources\RegistrationHistories\Pages;

use App\Filament\Admin\Resources\RegistrationHistories\RegistrationHistoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRegistrationHistory extends EditRecord
{
    protected static string $resource = RegistrationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
