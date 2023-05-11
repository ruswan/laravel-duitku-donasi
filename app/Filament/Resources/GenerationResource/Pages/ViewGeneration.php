<?php

namespace App\Filament\Resources\GenerationResource\Pages;

use App\Filament\Resources\GenerationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGeneration extends ViewRecord
{
    protected static string $resource = GenerationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
