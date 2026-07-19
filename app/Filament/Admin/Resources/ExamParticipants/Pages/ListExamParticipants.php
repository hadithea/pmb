<?php

namespace App\Filament\Admin\Resources\ExamParticipants\Pages;

use App\Filament\Admin\Resources\ExamParticipants\ExamParticipantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExamParticipants extends ListRecords
{
    protected static string $resource = ExamParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
