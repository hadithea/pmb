<?php

namespace App\Filament\Admin\Resources\ExamSessions\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExamParticipantsRelationManager extends RelationManager
{
    protected static string $relationship = 'examParticipants';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('registration_id')
                    ->relationship('registration', 'registration_number')
                    ->label('Registration')
                    ->searchable()
                    ->preload()
                    ->required(),
                DateTimePicker::make('start_time')
                    ->label('Start Time'),
                DateTimePicker::make('end_time')
                    ->label('End Time'),
                Select::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                        'abandoned' => 'Abandoned',
                    ])
                    ->default('scheduled')
                    ->required(),
                TextInput::make('total_score')
                    ->numeric()
                    ->label('Total Score'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('registration.registration_number')
                    ->label('No. Pendaftaran')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('registration.user.name')
                    ->label('Nama Peserta')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('total_score')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
