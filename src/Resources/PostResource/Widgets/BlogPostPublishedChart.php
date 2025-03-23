<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Firefly\FilamentBlog\Models\Post;

class BlogPostPublishedChart extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            BaseWidget\Stat::make(__('messages.filament-blog.published'), Post::published()->count()),
            BaseWidget\Stat::make(__('messages.filament-blog.scheduled'), Post::scheduled()->count()),
            BaseWidget\Stat::make(__('messages.filament-blog.pending'), Post::pending()->count()),
        ];
    }
}