<?php

namespace App\Filament\Admin\Resources\ExamSessions\Pages;

use App\Filament\Admin\Resources\ExamSessions\ExamSessionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExamSession extends CreateRecord
{
    protected static string $resource = ExamSessionResource::class;
}
