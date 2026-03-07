<?php

namespace App\Filament\Resources\WorkMessages\Pages;

use App\Filament\Resources\WorkMessages\WorkMessageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkMessage extends ViewRecord
{
    protected static string $resource = WorkMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
