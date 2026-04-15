<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Facades\Filament;

class Register extends BaseRegister
{
    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $panelId = Filament::getCurrentPanel()->getId();
        
        if ($panelId === 'admin') {
            $data['role'] = 'admin';
        } else {
            $data['role'] = 'penghuni';
        }

        return $data;
    }
}
