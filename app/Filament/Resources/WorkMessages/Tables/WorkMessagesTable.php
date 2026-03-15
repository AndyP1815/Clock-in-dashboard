<?php

namespace App\Filament\Resources\WorkMessages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorkMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('name')
                   ->label(__('Naam'))
                    ->searchable(),

                TextColumn::make('message')
                    ->label(__('Bericht'))
                    ->limit(50),

              IconColumn::make('is_end')
                  ->label(__('is eindbericht'))
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
