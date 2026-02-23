<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Schema;

class HourTotalReport extends Page
{

    protected static string $resource = EmployeeResource::class;

    protected string $view = 'filament.resources.employees.pages.hour-total-report';

    public string $month;
    public function mount($month = null): void
    {
        $this->month = $month ?? now()->subMonth()->format('Y-m');
        $this->form->fill(['selected_month' => $this->month]);
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
