<?php

namespace App\Filament\Admin\Resources\Penghunis\Pages;

use App\Filament\Admin\Resources\Penghunis\PenghuniResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPenghuni extends EditRecord
{
    protected static string $resource = PenghuniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
