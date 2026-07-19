<?php

namespace App\Filament\Admin\Resources\ExamParticipants\Pages;

use App\Filament\Admin\Resources\ExamParticipants\ExamParticipantResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExamParticipant extends EditRecord
{
    protected static string $resource = ExamParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
