<?php

namespace App\Filament\Admin\Resources\RegistrationHistories;

use App\Filament\Admin\Resources\RegistrationHistories\Pages\CreateRegistrationHistory;
use App\Filament\Admin\Resources\RegistrationHistories\Pages\EditRegistrationHistory;
use App\Filament\Admin\Resources\RegistrationHistories\Pages\ListRegistrationHistories;
use App\Filament\Admin\Resources\RegistrationHistories\Schemas\RegistrationHistoryForm;
use App\Filament\Admin\Resources\RegistrationHistories\Tables\RegistrationHistoriesTable;
use App\Models\RegistrationHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegistrationHistoryResource extends Resource
{
    protected static ?string $model = RegistrationHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RegistrationHistoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrationHistoriesTable::configure($table);
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
            'index' => ListRegistrationHistories::route('/'),
            'create' => CreateRegistrationHistory::route('/create'),
            'edit' => EditRegistrationHistory::route('/{record}/edit'),
        ];
    }
}
