<?php

namespace App\Filament\Resources\PageResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPage extends ViewRecord
{
    protected static string $resource = \App\Filament\Resources\PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
