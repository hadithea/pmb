<?php

namespace App\Filament\Admin\Resources\ExamAnswers;

use App\Filament\Admin\Resources\ExamAnswers\Pages\CreateExamAnswer;
use App\Filament\Admin\Resources\ExamAnswers\Pages\EditExamAnswer;
use App\Filament\Admin\Resources\ExamAnswers\Pages\ListExamAnswers;
use App\Filament\Admin\Resources\ExamAnswers\Schemas\ExamAnswerForm;
use App\Filament\Admin\Resources\ExamAnswers\Tables\ExamAnswersTable;
use App\Models\ExamAnswer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExamAnswerResource extends Resource
{
    protected static ?string $model = ExamAnswer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Bank Soal & Ujian Online';

    public static function form(Schema $schema): Schema
    {
        return ExamAnswerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamAnswersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExamAnswers::route('/'),
            'create' => CreateExamAnswer::route('/create'),
            'edit' => EditExamAnswer::route('/{record}/edit'),
        ];
    }
}
