<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Revenue Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Data Dummy Pendapatan',
                    'data' => [1000000, 2000000, 1500000, 3000000],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
