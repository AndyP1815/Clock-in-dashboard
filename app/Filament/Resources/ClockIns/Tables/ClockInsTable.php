<?php

namespace App\Filament\Resources\ClockIns\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClockInsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
                    ->label(__('Medewerker'))
                    ->searchable(),
                TextColumn::make('employee.employee_id')
                    ->label(__('Medewerker ID'))
                    ->searchable(),
                TextColumn::make('clock_in_time')
                    ->dateTime()
                    ->label(__('Ingeklokt om'))
                    ->sortable(),
                TextColumn::make('clock_out_time')
                    ->dateTime()
                    ->label(__('Uitgeklokt om'))
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('clock_in_time', direction: 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
