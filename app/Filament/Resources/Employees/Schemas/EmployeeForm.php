<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Enums\Roles;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label(__("Naam"))->required(),
                TextInput::make('employee_id')->label(__("Medewerker ID"))->required(),
                TextInput::make('last_name')->label(__("Achternaam"))->required(),
                Select::make('role')->label(__("Rol"))
                    ->options(collect(Roles::cases())->pluck('name', 'value')->toArray())
                    ->required()->default(Roles::Employee->value),
            ]);
    }
}
