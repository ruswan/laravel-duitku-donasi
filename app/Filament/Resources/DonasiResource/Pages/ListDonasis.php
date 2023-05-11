<?php

namespace App\Filament\Resources\DonasiResource\Pages;

use App\Filament\Resources\DonasiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonasis extends ListRecords
{
    protected static string $resource = DonasiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
