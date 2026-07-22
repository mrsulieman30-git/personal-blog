<?php

namespace App\Filament\Resources\ResumeItemResource\Pages;

use App\Filament\Resources\ResumeItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResumeItems extends ListRecords
{
    protected static string $resource = ResumeItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
