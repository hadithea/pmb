<?php

namespace App\Filament\Admin\Resources\Interviews\Pages;

use App\Filament\Admin\Resources\Interviews\InterviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInterview extends EditRecord
{
    protected static string $resource = InterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
