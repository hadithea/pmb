<?php

namespace App\Filament\Admin\Resources\ExamSessions;

use App\Filament\Admin\Resources\ExamSessions\Pages\CreateExamSession;
use App\Filament\Admin\Resources\ExamSessions\Pages\EditExamSession;
use App\Filament\Admin\Resources\ExamSessions\Pages\ListExamSessions;
use App\Filament\Admin\Resources\ExamSessions\Schemas\ExamSessionForm;
use App\Filament\Admin\Resources\ExamSessions\Tables\ExamSessionsTable;
use App\Filament\Admin\Resources\ExamSessions\RelationManagers\ExamParticipantsRelationManager;
use App\Models\ExamSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExamSessionResource extends Resource
{
    protected static ?string $model = ExamSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Bank Soal & Ujian Online';

    public static function form(Schema $schema): Schema
    {
        return ExamSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamSessionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ExamParticipantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExamSessions::route('/'),
            'create' => CreateExamSession::route('/create'),
            'edit' => EditExamSession::route('/{record}/edit'),
        ];
    }
}
