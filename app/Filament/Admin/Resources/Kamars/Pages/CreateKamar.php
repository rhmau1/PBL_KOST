<?php

namespace App\Filament\Admin\Resources\Kamars\Pages;

use App\Filament\Admin\Resources\Kamars\KamarResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKamar extends CreateRecord
{
    protected static string $resource = KamarResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $kos = \App\Models\Kos::where('user_id', auth()->id())->first();

        if ($kos) {
            $data['kos_id'] = $kos->id;
        }

        return $data;
    }
}
