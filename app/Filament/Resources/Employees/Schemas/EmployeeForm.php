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
                TextInput::make('name')->label(__("Name"))->required(),
                TextInput::make('employee_id')->label(__("Employee ID"))->required(),
                Select::make('role')->label(__("Role"))
                    ->options(collect(Roles::cases())->pluck('name', 'value')->toArray())->required(),
            ]);
    }
}
