<?php

namespace App\Filament\Resources\PriceSections\Pages;

use App\Filament\Resources\PriceSections\PriceSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePriceSections extends ManageRecords
{
    protected static string $resource = PriceSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
