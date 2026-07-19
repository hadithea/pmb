<?php

namespace App\Filament\Admin\Resources\Interviews;

use App\Filament\Admin\Resources\Interviews\Pages\CreateInterview;
use App\Filament\Admin\Resources\Interviews\Pages\EditInterview;
use App\Filament\Admin\Resources\Interviews\Pages\ListInterviews;
use App\Filament\Admin\Resources\Interviews\Schemas\InterviewForm;
use App\Filament\Admin\Resources\Interviews\Tables\InterviewsTable;
use App\Models\Interview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InterviewResource extends Resource
{
    protected static ?string $model = Interview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Wawancara';

    public static function form(Schema $schema): Schema
    {
        return InterviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InterviewsTable::configure($table);
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
            'index' => ListInterviews::route('/'),
            'create' => CreateInterview::route('/create'),
            'edit' => EditInterview::route('/{record}/edit'),
        ];
    }
}
