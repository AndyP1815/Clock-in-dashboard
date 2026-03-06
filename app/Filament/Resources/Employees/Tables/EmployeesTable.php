<?php

namespace App\Filament\Resources\Employees\Tables;

use App\Enums\Roles;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('ID')),
                TextColumn::make('employee_id')->label(__('Employee ID')),

                // 2. Add the Red Icon logic to the Name column
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->icon(fn ($record) =>  $record->hasIssues() ? 'heroicon-m-exclamation-circle' : null)
                    ->iconColor('danger'),

                TextColumn::make('role')->label(__('Role')),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label(__('Role'))
                    ->options(Roles::class) // Filament supports Enums directly
                    ->default(Roles::Employee->value)
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
