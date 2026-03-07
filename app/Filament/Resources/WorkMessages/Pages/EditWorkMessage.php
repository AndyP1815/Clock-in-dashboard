<?php

namespace App\Filament\Resources\WorkMessages\Pages;

use App\Filament\Resources\WorkMessages\WorkMessageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWorkMessage extends EditRecord
{
    protected static string $resource = WorkMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
