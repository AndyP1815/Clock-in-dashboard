<?php

namespace App\Filament\Resources\Employees\RelationManagers;

use App\Enums\Status;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClockInRelationManager extends RelationManager
{
    protected static string $relationship = 'clockIns';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('clock_in_time')
                    ->label(__('Ingeklokt om'))
                    ->timezone('Europe/Amsterdam')
                    ->required()
            ,

                DateTimePicker::make('clock_out_time')
                    ->label(__('Uitgeklokt om'))
                    ->timezone('Europe/Amsterdam')
                    ->required()

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('clockIn')
            ->columns([
                TextColumn::make('status')
                    ->label(__("Status"))
                    ->badge() // Optional: makes it look like a pill
                    ->color(fn (Status $state): string => $state->getColor()),

                TextColumn::make('clock_in_time')
                    ->label(__("Ingeklokt om"))
                    ->timezone('Europe/Amsterdam')
                    ->dateTime(),

                TextColumn::make('clock_out_time')
                    ->label(__("Uitgeklokt om"))
                    ->timezone('Europe/Amsterdam')
                    ->dateTime(),
            ])
            ->defaultSort('clock_in_time', direction: 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                //   AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make()->disabled(function ($record)
                {
                    return $record->status === Status::Pending;
                }),
        //        DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                 //   DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
