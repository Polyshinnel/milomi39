<?php

namespace App\Filament\Resources\PriceVariants\Pages;

use App\Filament\Resources\PriceVariants\PriceVariantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePriceVariants extends ManageRecords
{
    protected static string $resource = PriceVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
