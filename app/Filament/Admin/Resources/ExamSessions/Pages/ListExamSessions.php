<?php

namespace App\Filament\Admin\Resources\ExamSessions\Pages;

use App\Filament\Admin\Resources\ExamSessions\ExamSessionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExamSessions extends ListRecords
{
    protected static string $resource = ExamSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
