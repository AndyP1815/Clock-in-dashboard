<?php

namespace App\Filament\Resources\Employees;

use App\Filament\Resources\Employees\Pages\CreateEmployee;
use App\Filament\Resources\Employees\Pages\EditEmployee;
use App\Filament\Resources\Employees\Pages\HourReport;
use App\Filament\Resources\Employees\Pages\HourTotalReport;
use App\Filament\Resources\Employees\Pages\ListEmployees;
use App\Filament\Resources\Employees\Schemas\EmployeeForm;
use App\Filament\Resources\Employees\Tables\EmployeesTable;
use App\Models\Employee;
use BackedEnum;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Employee';
    protected static ?int $navigationSort = 1;
    public static function form(Schema $schema): Schema
    {
        return EmployeeForm::configure($schema);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        // This "eager loads" the clock-ins so the hasIssues() method is fast
        return parent::getEloquentQuery()->with(['clockIns']);
    }
    public static function table(Table $table): Table
    {
        return EmployeesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ClockInRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployees::route('/'),
            'create' => CreateEmployee::route('/create'),
            'edit' => EditEmployee::route('/{record}/edit'),
            'hourTotalReport' => HourTotalReport::route('/hour-total-report/{month?}'),
            'hourReport' => HourReport::route('/{record}/hour-report/{month?}'),
        ];
    }
}
