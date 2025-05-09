<?php

namespace Firefly\FilamentBlog\Resources\TagResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Firefly\FilamentBlog\Resources\TagResource;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;

    public function getTitle(): string
    {
        return __('messages.filament-blog.create_tag');
    }
}