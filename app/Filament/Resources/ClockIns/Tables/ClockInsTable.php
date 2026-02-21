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
                    ->label(__('Employee'))
                    ->searchable(),
                TextColumn::make('employee.employee_id')
                    ->label(__('Employee ID'))
                    ->searchable(),
                TextColumn::make('clock_in_time')
                    ->dateTime()
                    ->label(__('Clock In Time'))
                    ->sortable(),
                TextColumn::make('clock_out_time')
                    ->dateTime()
                    ->label(__('Clock Out Time'))
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->sortable()
                    ->searchable(),
            ])
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
