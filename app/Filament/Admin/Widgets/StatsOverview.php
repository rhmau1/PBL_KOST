<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Kamar;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $kamarTerisi = Kamar::where('status', true)->count();
        $totalKamar = Kamar::count();
        $estimasiPendapatan = Kamar::where('status', true)->sum('harga');

        return [
            Stat::make('Kamar Terisi', "$kamarTerisi / $totalKamar")
                ->icon('heroicon-o-home'),

            Stat::make('Estimasi Pendapatan', 'Rp '.number_format($estimasiPendapatan))
                ->icon('heroicon-o-banknotes'),

            Stat::make('Kamar Kosong', $totalKamar - $kamarTerisi)
                ->icon('heroicon-o-home')
                ->color('danger'),
        ];
    }
}
