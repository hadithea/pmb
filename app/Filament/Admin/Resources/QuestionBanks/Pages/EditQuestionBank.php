<?php

namespace App\Filament\Admin\Resources\QuestionBanks\Pages;

use App\Filament\Admin\Resources\QuestionBanks\QuestionBankResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQuestionBank extends EditRecord
{
    protected static string $resource = QuestionBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
