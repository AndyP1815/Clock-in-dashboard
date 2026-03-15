<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make("hourReport")
                ->label(__("Uren rapport"))
                ->icon('heroicon-m-document-chart-bar')
                ->color('gray')
                ->outlined()
                ->url(fn() => $this->getResource()::getUrl("hourTotalReport")),

            // Primary Action: The "Hero" of the page
            CreateAction::make()
                ->label(__('Nieuwe medewerker'))
                ->icon('heroicon-m-user-plus'),
        ];
    }
}
