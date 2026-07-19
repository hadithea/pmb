<?php

namespace App\Filament\Admin\Resources\SelectionResults;

use App\Filament\Admin\Resources\SelectionResults\Pages\CreateSelectionResult;
use App\Filament\Admin\Resources\SelectionResults\Pages\EditSelectionResult;
use App\Filament\Admin\Resources\SelectionResults\Pages\ListSelectionResults;
use App\Filament\Admin\Resources\SelectionResults\Schemas\SelectionResultForm;
use App\Filament\Admin\Resources\SelectionResults\Tables\SelectionResultsTable;
use App\Models\SelectionResult;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SelectionResultResource extends Resource
{
    protected static ?string $model = SelectionResult::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SelectionResultForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SelectionResultsTable::configure($table);
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
            'index' => ListSelectionResults::route('/'),
            'create' => CreateSelectionResult::route('/create'),
            'edit' => EditSelectionResult::route('/{record}/edit'),
        ];
    }
}
