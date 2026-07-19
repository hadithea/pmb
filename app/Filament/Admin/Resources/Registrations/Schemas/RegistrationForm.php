<?php

namespace App\Filament\Admin\Resources\Registrations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('period_id')
                    ->relationship('period', 'name')
                    ->required(),
                Select::make('selection_path_id')
                    ->relationship('selectionPath', 'name')
                    ->required(),
                TextInput::make('registration_number')
                    ->required(),
                Select::make('study_program_1_id')
                    ->relationship('studyProgram1', 'name')
                    ->required(),
                Select::make('study_program_2_id')
                    ->relationship('studyProgram2', 'name'),
                TextInput::make('personal_data'),
                TextInput::make('education_data'),
                TextInput::make('parent_data'),
                TextInput::make('files'),
                TextInput::make('utbk_score')
                    ->numeric(),
                TextInput::make('payment_number'),
                TextInput::make('payment_amount')
                    ->numeric(),
                DateTimePicker::make('payment_date'),
                TextInput::make('payment_status')
                    ->required()
                    ->default('unpaid'),
                TextInput::make('verification_status')
                    ->required()
                    ->default('pending'),
                TextInput::make('participant_card_number'),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
            ]);
    }
}
