<?php

namespace App\Filament\Admin\Resources\Quotas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuotaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('period_id')
                    ->relationship('period', 'name')
                    ->required(),
                Select::make('selection_path_id')
                    ->relationship('selectionPath', 'name')
                    ->required(),
                Select::make('study_program_id')
                    ->relationship('studyProgram', 'name')
                    ->required(),
                TextInput::make('quota_amount')
                    ->required()
                    ->numeric(),
            ]);
    }
}
