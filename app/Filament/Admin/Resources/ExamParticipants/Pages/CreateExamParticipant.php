<?php

namespace App\Filament\Admin\Resources\ExamParticipants\Pages;

use App\Filament\Admin\Resources\ExamParticipants\ExamParticipantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExamParticipant extends CreateRecord
{
    protected static string $resource = ExamParticipantResource::class;
}
