<?php

namespace App\Filament\Admin\Resources\SelectionResults\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SelectionResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('registration_id')
                    ->relationship('registration', 'id')
                    ->required(),
                TextInput::make('total_score')
                    ->numeric(),
                TextInput::make('rank')
                    ->numeric(),
                TextInput::make('status')
                    ->required(),
                Select::make('accepted_study_program_id')
                    ->relationship('acceptedStudyProgram', 'name'),
                DateTimePicker::make('announcement_date'),
            ]);
    }
}
