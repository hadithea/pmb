<?php

namespace App\Filament\Admin\Resources\ExamAnswers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExamAnswerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('exam_participant_id')
                    ->relationship('examParticipant', 'id')
                    ->required(),
                Select::make('question_bank_id')
                    ->relationship('questionBank', 'id')
                    ->required(),
                Textarea::make('answer')
                    ->columnSpanFull(),
                Toggle::make('is_correct'),
                TextInput::make('score')
                    ->numeric(),
            ]);
    }
}
