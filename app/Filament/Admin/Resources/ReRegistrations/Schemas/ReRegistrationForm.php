<?php

namespace App\Filament\Admin\Resources\ReRegistrations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('selection_result_id')
                    ->relationship('selectionResult', 'id')
                    ->required(),
                TextInput::make('payment_number'),
                TextInput::make('ukt_amount')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('payment_date'),
                TextInput::make('payment_status')
                    ->required()
                    ->default('unpaid'),
                TextInput::make('files'),
                TextInput::make('verification_status')
                    ->required()
                    ->default('pending'),
                TextInput::make('nim'),
                DateTimePicker::make('generated_date'),
            ]);
    }
}
