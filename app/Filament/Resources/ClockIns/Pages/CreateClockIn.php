<?php

namespace App\Filament\Resources\ClockIns\Pages;

use App\Filament\Resources\ClockIns\ClockInResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClockIn extends CreateRecord
{
    protected static string $resource = ClockInResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
