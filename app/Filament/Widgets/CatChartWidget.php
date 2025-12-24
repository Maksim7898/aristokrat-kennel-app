<?php

namespace App\Filament\Widgets;

use App\Models\Cat;
use CyrildeWit\EloquentViewable\Support\Period;
use Filament\Widgets\ChartWidget;

class CatChartWidget extends ChartWidget
{
    protected ?string $heading = 'Динамика просмотров котов';

    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return auth()->user()->is_admin;
    }

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $labels[] = now()->subDays($i)->isoFormat('dd (DD.MM)');

            $data[] = views(Cat::class)
                ->period(Period::create(
                    now()->subDays($i)->startOfDay(),
                    now()->subDays($i)->endOfDay()
                ))
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Просмотры',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
