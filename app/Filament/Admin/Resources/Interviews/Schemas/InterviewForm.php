<?php

namespace App\Filament\Admin\Resources\Interviews\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InterviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('registration_id')
                    ->relationship('registration', 'id')
                    ->required(),
                Select::make('interviewer_id')
                    ->relationship('interviewer', 'name')
                    ->required(),
                DateTimePicker::make('schedule_time')
                    ->required(),
                TextInput::make('meeting_link'),
                TextInput::make('status')
                    ->required()
                    ->default('scheduled'),
                TextInput::make('components_score'),
                TextInput::make('total_score')
                    ->numeric(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('duration_minutes')
                    ->numeric(),
            ]);
    }
}
