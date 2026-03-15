<?php

namespace App\Filament\Resources\WorkMessages\Schemas;

use App\Enums\Roles;
use App\Models\Employee;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WorkMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Naam'))
                    ->required()
                    ->maxLength(100),

               Textarea::make('message')
                   ->label(__('Bericht'))
                    ->required(),

               Toggle::make('is_end')
                    ->label(__('Is het een eindbericht'))
                    ->default(true),

                CheckboxList::make('employees')
                    ->label(__('medewerkers'))
                    ->relationship(
                        'employees',
                        'name',
                        modifyQueryUsing: fn ($query) => $query->where('role', Roles::Employee->value)
                    )
                    ->columns(4)
                    ->bulkToggleable()
                    ->searchable()
            ]);
    }
}
