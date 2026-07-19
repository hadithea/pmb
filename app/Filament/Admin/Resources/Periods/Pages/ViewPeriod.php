<?php

namespace App\Filament\Admin\Resources\Periods\Pages;

use App\Filament\Admin\Resources\Periods\PeriodResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPeriod extends ViewRecord
{
    protected static string $resource = PeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
