<?php

namespace App\Filament\Resources\SpecialOffers\Pages;

use App\Filament\Resources\SpecialOffers\SpecialOfferResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSpecialOffers extends ManageRecords
{
    protected static string $resource = SpecialOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
