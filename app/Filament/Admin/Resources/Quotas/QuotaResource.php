<?php

namespace App\Filament\Admin\Resources\Quotas;

use App\Filament\Admin\Resources\Quotas\Pages\CreateQuota;
use App\Filament\Admin\Resources\Quotas\Pages\EditQuota;
use App\Filament\Admin\Resources\Quotas\Pages\ListQuotas;
use App\Filament\Admin\Resources\Quotas\Schemas\QuotaForm;
use App\Filament\Admin\Resources\Quotas\Tables\QuotasTable;
use App\Models\Quota;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuotaResource extends Resource
{
    protected static ?string $model = Quota::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return QuotaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuotasTable::configure($table);
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
            'index' => ListQuotas::route('/'),
            'create' => CreateQuota::route('/create'),
            'edit' => EditQuota::route('/{record}/edit'),
        ];
    }
}
