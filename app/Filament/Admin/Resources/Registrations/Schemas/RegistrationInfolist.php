<?php

namespace App\Filament\Admin\Resources\Registrations\Schemas;

use App\Models\Registration;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RegistrationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('period.name')
                    ->label('Period'),
                TextEntry::make('selectionPath.name')
                    ->label('Selection path'),
                TextEntry::make('registration_number'),
                TextEntry::make('studyProgram1.name')
                    ->label('Study program1'),
                TextEntry::make('studyProgram2.name')
                    ->label('Study program2')
                    ->placeholder('-'),
                TextEntry::make('utbk_score')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('payment_number')
                    ->placeholder('-'),
                TextEntry::make('payment_amount')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('payment_date')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('payment_status'),
                TextEntry::make('verification_status'),
                TextEntry::make('participant_card_number')
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Registration $record): bool => $record->trashed()),
            ]);
    }
}
