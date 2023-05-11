<?php

namespace App\Filament\Resources\CampaignStatusResource\Pages;

use App\Filament\Resources\CampaignStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCampaignStatuses extends ListRecords
{
    protected static string $resource = CampaignStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
