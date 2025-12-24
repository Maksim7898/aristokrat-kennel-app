<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use CyrildeWit\EloquentViewable\Support\Period;
use Filament\Widgets\ChartWidget;

class PostChartWidget extends ChartWidget
{
    protected ?string $heading = 'Динамика просмотров постов';

    protected static ?int $sort = 3;

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

            $data[] = views(Post::class)
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
