<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Pages;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Resources\PostResource;
use Illuminate\Contracts\Support\Htmlable;

class ManaePostSeoDetail extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'seoDetail';

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public function getTitle(): string|Htmlable
    {

        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return __('filament-blog::pages.manage-seo-details');
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.filament-blog.manage_seo_details');
    }

    protected function canCreate(): bool
    {
        return !$this->getRelationship()->count();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('messages.filament-blog.title'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TagsInput::make('keywords')
                    ->label(__('messages.filament-blog.keywords'))
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label(__('messages.filament-blog.description'))
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('messages.filament-blog.title'))
                    ->limit(20),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('messages.filament-blog.description'))
                    ->limit(40),
                Tables\Columns\TextColumn::make('keywords')
                    ->label(__('messages.filament-blog.keywords'))
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('messages.filament-blog.created_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('messages.filament-blog.updated_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])->paginated(false);
    }
}