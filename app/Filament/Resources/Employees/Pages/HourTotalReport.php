<?php

namespace App\Filament\Resources\Employees\Pages;

use App\DTOs\TableDTO;
use App\Enums\Roles;
use App\Filament\Resources\Employees\EmployeeResource;
use App\Helpers\ReportHelper;
use App\Models\Employee;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Schema;

class HourTotalReport extends Page
{

    protected static string $resource = EmployeeResource::class;

    protected string $view = 'filament.resources.employees.pages.hour-total-report';

    public string $month;
    public array $data = [];

    /**
     * @throws \Exception
     */
    public function mount($month = null): void
    {
        $this->month = $month ?? now()->subMonth()->format('Y-m');
        $this->form->fill(['selected_month' => $this->month]);

        // 1. Move the 'where' into the query builder for better performance
        // This lets PostgreSQL do the filtering instead of PHP's memory
        $employees = Employee::query()
            ->where('role', Roles::Employee->value)
            ->get();

        // 2. Call the report helper
        $dto = ReportHelper::monthlyEmployeeReport($this->month, $employees);

        // 3. FIX: Use -> instead of . to call the toArray() method
        $this->data = $dto->toArray();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('selected_month')
                    ->label(__('Select Month'))
                    ->options($this->getMonthOptions())
                    ->statePath('month') // Connects the Select directly to your public $month property
                    ->live()
                    ->afterStateUpdated(function ($state, $livewire) {
                        $livewire->redirectToMonth($state);
                    }),
            ]);
    }

    public function redirectToMonth($month): void
    {
        $this->redirect(
            static::getResource()::getUrl('hourTotalReport', [
                'month' => $month,
            ]),
            navigate: true // This enables SPA-like navigation in v5
        );
    }

    protected function getMonthOptions(): array
    {
        $options = [];
        $date = now()->startOfMonth();
        for ($i = 0; $i < 12; $i++) {
            $options[$date->format('Y-m')] = $date->format('F Y');
            $date->subMonth();
        }
        return $options;
    }
}
