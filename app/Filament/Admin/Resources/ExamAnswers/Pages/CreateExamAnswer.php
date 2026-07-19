<?php

namespace App\Filament\Admin\Resources\ExamAnswers\Pages;

use App\Filament\Admin\Resources\ExamAnswers\ExamAnswerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExamAnswer extends CreateRecord
{
    protected static string $resource = ExamAnswerResource::class;
}
