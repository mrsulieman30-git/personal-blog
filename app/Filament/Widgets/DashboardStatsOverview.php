<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\BlogComment;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Posts', BlogPost::where('is_published', true)->count())
                ->description('Published blog posts')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Total Views', number_format(BlogPost::sum('views')))
                ->description('All-time page views')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),

            Stat::make('Comments', BlogComment::count())
                ->description('Reader engagement')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('warning'),

            Stat::make('Projects', Project::where('is_published', true)->count())
                ->description('Published portfolio projects')
                ->descriptionIcon('heroicon-m-rocket-launch')
                ->color('info'),
        ];
    }
}
