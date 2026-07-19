<?php

namespace App\Filament\Admin\Resources\ExamAnswers\Pages;

use App\Filament\Admin\Resources\ExamAnswers\ExamAnswerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExamAnswer extends EditRecord
{
    protected static string $resource = ExamAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
