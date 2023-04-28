<?php

namespace App\Filament\Resources\LocalityResource\Pages;

use App\Filament\Resources\LocalityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLocalities extends ManageRecords
{
    protected static string $resource = LocalityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
