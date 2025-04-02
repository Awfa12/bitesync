<?php

namespace App\Filament\Admin\Resources\RestaurantOwnerResource\Pages;

use App\Filament\Admin\Resources\RestaurantOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestaurantOwner extends EditRecord
{
    protected static string $resource = RestaurantOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
