<?php

namespace App\Filament\Admin\Resources\Exams\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('period_id')
                    ->relationship('period', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('duration_minutes')
                    ->required()
                    ->numeric(),
            ]);
    }
}
