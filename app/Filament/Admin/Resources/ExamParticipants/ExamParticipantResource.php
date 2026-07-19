<?php

namespace App\Filament\Admin\Resources\ExamParticipants;

use App\Filament\Admin\Resources\ExamParticipants\Pages\CreateExamParticipant;
use App\Filament\Admin\Resources\ExamParticipants\Pages\EditExamParticipant;
use App\Filament\Admin\Resources\ExamParticipants\Pages\ListExamParticipants;
use App\Filament\Admin\Resources\ExamParticipants\Schemas\ExamParticipantForm;
use App\Filament\Admin\Resources\ExamParticipants\Tables\ExamParticipantsTable;
use App\Models\ExamParticipant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExamParticipantResource extends Resource
{
    protected static ?string $model = ExamParticipant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ExamParticipantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamParticipantsTable::configure($table);
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
            'index' => ListExamParticipants::route('/'),
            'create' => CreateExamParticipant::route('/create'),
            'edit' => EditExamParticipant::route('/{record}/edit'),
        ];
    }
}
