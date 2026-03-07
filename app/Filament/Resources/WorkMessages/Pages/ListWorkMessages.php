<?php

namespace App\Filament\Resources\WorkMessages\Pages;

use App\Filament\Resources\WorkMessages\WorkMessageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorkMessages extends ListRecords
{
    protected static string $resource = WorkMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
