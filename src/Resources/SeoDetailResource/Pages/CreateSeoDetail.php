<?php

namespace Firefly\FilamentBlog\Resources\SeoDetailResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Firefly\FilamentBlog\Resources\SeoDetailResource;

class CreateSeoDetail extends CreateRecord
{
    protected static string $resource = SeoDetailResource::class;

    public function getTitle(): string
    {
        return __('messages.filament-blog.create_seo_detail');
    }
}