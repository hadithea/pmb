<?php

namespace App\Filament\Admin\Resources\ExamSessions\Pages;

use App\Filament\Admin\Resources\ExamSessions\ExamSessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExamSession extends EditRecord
{
    protected static string $resource = ExamSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
