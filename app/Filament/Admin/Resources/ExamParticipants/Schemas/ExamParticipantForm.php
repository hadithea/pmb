<?php

namespace App\Filament\Admin\Resources\ExamParticipants\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamParticipantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('exam_session_id')
                    ->relationship('examSession', 'name')
                    ->required(),
                Select::make('registration_id')
                    ->relationship('registration', 'id')
                    ->required(),
                DateTimePicker::make('start_time'),
                DateTimePicker::make('end_time'),
                TextInput::make('status')
                    ->required()
                    ->default('not_started'),
                TextInput::make('total_score')
                    ->numeric(),
                TextInput::make('proctoring_logs'),
            ]);
    }
}
