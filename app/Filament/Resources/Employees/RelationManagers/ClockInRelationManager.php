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
                    ->native(false) // Uses the cleaner Filament UI instead of browser default
                    ->displayFormat('d-m-Y H:i')
                    ->minutesStep(5) // Allows quicker selection (e.g., 05, 10, 15)
                    ->withoutSeconds()
                    ->prefixIcon('heroicon-m-clock')
                    ->required(),

                DateTimePicker::make('clock_out_time')
                    ->label(__('Uitgeklokt om'))
                    ->timezone('Europe/Amsterdam')
                    ->native(false)
                    ->displayFormat('d-m-Y H:i')
                    ->minutesStep(5)
                    ->withoutSeconds()
                    ->prefixIcon('heroicon-m-arrow-right-on-rectangle')
                    ->after('clock_in_time') // Validation: ensures out is after in
                    ->required(),
            ])
            ->columns(1);
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
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('clock_out_time')
                    ->label(__("Uitgeklokt om"))
                    ->timezone('Europe/Amsterdam')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->defaultSort('clock_in_time', direction: 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->createAnother(false),
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
