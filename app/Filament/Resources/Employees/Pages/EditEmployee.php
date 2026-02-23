<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Action::make("hourReport")
                ->label(__("Hour report"))
                ->action(fn() => redirect($this->getResource()::getUrl("hourReport",['record' => $this->getRecord(),'month' => now()->subMonth()->format('Y-m'),]))),
        ];
    }
}
