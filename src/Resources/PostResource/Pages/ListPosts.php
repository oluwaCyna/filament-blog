<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\PostResource;
use Firefly\FilamentBlog\Resources\PostResource\Widgets\BlogPostPublishedChart;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    public function getTitle(): string
    {
        return __('filament-blog::filament-blog.posts');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BlogPostPublishedChart::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->label(__('filament-blog::filament-blog.all')),
            'published' => Tab::make('Published')
                ->label(__('filament-blog::filament-blog.published'))
                ->modifyQueryUsing(function ($query) {
                    $query->published();
                })->icon('heroicon-o-check-badge'),
            'pending' => Tab::make('Pending')
                ->label(__('filament-blog::filament-blog.pending'))
                ->modifyQueryUsing(function ($query) {
                    $query->pending();
                })
                ->icon('heroicon-o-clock'),
            'scheduled' => Tab::make('Scheduled')
                ->label(__('filament-blog::filament-blog.scheduled'))
                ->modifyQueryUsing(function ($query) {
                    $query->scheduled();
                })
                ->icon('heroicon-o-calendar-days'),
        ];
    }
}