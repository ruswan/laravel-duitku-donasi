<?php

namespace App\Filament\Resources\DonasiResource\Pages;

use App\Filament\Resources\DonasiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonasi extends EditRecord
{
    protected static string $resource = DonasiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
