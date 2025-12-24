<?php

namespace App\Filament\Widgets;

use App\Enums\CatRequestStatusEnum;
use App\Enums\CatStatusEnum;
use App\Models\Cat;
use App\Models\CatRequest;
use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CatStatWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 2;

    public static function canView(): bool
    {
        return auth()->user()->is_admin;
    }
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Котов на продаже',
                Cat::where('status', CatStatusEnum::FOR_SALE)->count()
            )
                ->description('За неделю: '.Cat::where('status', CatStatusEnum::FOR_SALE)->where('created_at', '>=', now()->subDays(7))->count()),

            Stat::make(
                'Проданных котов',
                Cat::where('status', CatStatusEnum::SOLD)->count()
            )
                ->description('За неделю: '.Cat::where('status', CatStatusEnum::SOLD)->where('created_at', '>=', now()->subDays(7))->count()),

            Stat::make(
                'Просмотров за 7 дней',
                views(Cat::class)->count()
            )
                ->description('Уникальных просмотров: '.views(Cat::class)->unique()->count()),

            Stat::make(
                'Количество отзывов',
                Review::count()
            )
                ->description('За неделю: '.Review::where('created_at', '>=', now()->subDays(7))->count()),

            Stat::make(
                'Количество заявок',
                CatRequest::count()
            )
                ->description('За неделю: '.CatRequest::where('created_at', '>=', now()->subDays(7))->count()),

            Stat::make(
                'Количество одобренных заявок',
                CatRequest::where('status', CatRequestStatusEnum::READY)->count()
            )
                ->description('За неделю: '.CatRequest::where('status', CatRequestStatusEnum::READY)->where('created_at', '>=', now()->subDays(7))->count()),
        ];
    }
}
