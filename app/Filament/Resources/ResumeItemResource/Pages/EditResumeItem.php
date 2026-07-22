<?php

namespace App\Filament\Resources\ResumeItemResource\Pages;

use App\Filament\Resources\ResumeItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResumeItem extends EditRecord
{
    protected static string $resource = ResumeItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
