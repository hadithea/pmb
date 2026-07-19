<?php

namespace App\Filament\Admin\Resources\Interviewers\Pages;

use App\Filament\Admin\Resources\Interviewers\InterviewerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInterviewers extends ListRecords
{
    protected static string $resource = InterviewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
