<?php

namespace App\Filament\Resources\CampaignStatusResource\Pages;

use App\Filament\Resources\CampaignStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCampaignStatus extends EditRecord
{
    protected static string $resource = CampaignStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
