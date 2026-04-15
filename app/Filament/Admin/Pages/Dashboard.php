<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\RevenueChart;
use App\Filament\Admin\Widgets\StatsOverview;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected string $view = 'filament.admin.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            RevenueChart::class,
        ];
    }
}
