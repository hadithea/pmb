<?php

namespace App\Filament\Admin\Resources\ReRegistrations;

use App\Filament\Admin\Resources\ReRegistrations\Pages\CreateReRegistration;
use App\Filament\Admin\Resources\ReRegistrations\Pages\EditReRegistration;
use App\Filament\Admin\Resources\ReRegistrations\Pages\ListReRegistrations;
use App\Filament\Admin\Resources\ReRegistrations\Schemas\ReRegistrationForm;
use App\Filament\Admin\Resources\ReRegistrations\Tables\ReRegistrationsTable;
use App\Models\ReRegistration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReRegistrationResource extends Resource
{
    protected static ?string $model = ReRegistration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ReRegistrationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReRegistrationsTable::configure($table);
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
            'index' => ListReRegistrations::route('/'),
            'create' => CreateReRegistration::route('/create'),
            'edit' => EditReRegistration::route('/{record}/edit'),
        ];
    }
}
