<?php

namespace App\Filament\Admin\Resources\SelectionPaths;

use App\Filament\Admin\Resources\SelectionPaths\Pages\CreateSelectionPath;
use App\Filament\Admin\Resources\SelectionPaths\Pages\EditSelectionPath;
use App\Filament\Admin\Resources\SelectionPaths\Pages\ListSelectionPaths;
use App\Filament\Admin\Resources\SelectionPaths\Schemas\SelectionPathForm;
use App\Filament\Admin\Resources\SelectionPaths\Tables\SelectionPathsTable;
use App\Models\SelectionPath;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SelectionPathResource extends Resource
{
    protected static ?string $model = SelectionPath::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return SelectionPathForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SelectionPathsTable::configure($table);
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
            'index' => ListSelectionPaths::route('/'),
            'create' => CreateSelectionPath::route('/create'),
            'edit' => EditSelectionPath::route('/{record}/edit'),
        ];
    }
}
