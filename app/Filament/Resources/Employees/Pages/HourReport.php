<?php
namespace App\Filament\Resources\Employees\Pages;

use App\DTOs\TableDTO;
use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class HourReport extends Page implements HasForms
{
    use InteractsWithRecord, InteractsWithForms;

    protected static string $resource = EmployeeResource::class;
    protected string $view = 'filament.resources.employees.pages.hour-report';

    public ?string $month = null;
    public array $data = [];

    /**
     * @throws \Exception
     */
    public function mount(int|string $record, ?string $month = null): void
    {
        $this->record = $this->resolveRecord($record);
        $this->month = $month ?? now()->subMonth()->format('Y-m');

        $this->form->fill(['selected_month' => $this->month]);
        $dto = new TableDTO(['Date', 'In', 'Out', 'Hours'], [["help","help","help","help"]], [
            '', '', 'Total:', '40.50'
        ]);

        // Convert to array so Livewire can handle it
        $this->data = (array) $dto;
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
            static::getResource()::getUrl('hourReport', [
                'record' => $this->record,
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
