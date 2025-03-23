<?php

namespace Firefly\FilamentBlog\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Firefly\FilamentBlog\Resources\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    public function getTitle(): string
    {
        return __('messages.filament-blog.create_category');
    }
}