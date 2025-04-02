<?php

namespace App\Filament\Admin\Resources\RestaurantOwnerResource\Pages;

use App\Filament\Admin\Resources\RestaurantOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRestaurantOwners extends ListRecords
{
    protected static string $resource = RestaurantOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
