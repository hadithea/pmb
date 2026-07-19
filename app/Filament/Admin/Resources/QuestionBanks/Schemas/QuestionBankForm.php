<?php

namespace App\Filament\Admin\Resources\QuestionBanks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class QuestionBankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                TextInput::make('type')
                    ->required()
                    ->default('multiple_choice'),
                TextInput::make('difficulty_level')
                    ->required()
                    ->default('medium'),
                Textarea::make('question_text')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('options'),
                TextInput::make('answer_key'),
            ]);
    }
}
