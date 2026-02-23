<?php

namespace App\Filament\Resources\ClockIns\Schemas;

use App\Enums\Roles;
use App\Enums\Status;
use App\Models\Employee;
use Couchbase\Role;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ClockInForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->label(__('Employee'))
                    ->options(
                        Employee::where('role', Roles::Employee->value)
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(),
                DateTimePicker::make('clock_in_time')
                    ->label(__('Clock In'))
                    ->required(),
                DateTimePicker::make('clock_out_time')
                ->label(__('Clock Out'))
                ->required(),
                Select::make('status')
                    ->hidden()
                    ->label(__('Status'))
                    ->options(Status::class)
                    ->default('Done'),
            ]);
    }
}
