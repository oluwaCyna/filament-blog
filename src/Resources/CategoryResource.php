<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Resources\CategoryResource\RelationManagers\PostsRelationManager;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('messages.filament-blog.categories');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Category::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('messages.filament-blog.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('messages.filament-blog.slug')),
                Tables\Columns\TextColumn::make('posts_count')
                    ->label(__('messages.filament-blog.posts_count'))
                    ->badge()
                    ->counts('posts'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('messages.filament-blog.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('messages.filament-blog.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Category')
                ->label(__('messages.filament-blog.category'))
                ->schema([
                    TextEntry::make('name')
                        ->label(__('messages.filament-blog.name')),
                    TextEntry::make('slug')
                        ->label(__('messages.filament-blog.slug')),
                ])->columns(2)
                ->icon('heroicon-o-square-3-stack-3d'),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Firefly\FilamentBlog\Resources\CategoryResource\Pages\ListCategories::route('/'),
            'edit' => \Firefly\FilamentBlog\Resources\CategoryResource\Pages\EditCategory::route('/{record}/edit'),
            'view' => \Firefly\FilamentBlog\Resources\CategoryResource\Pages\ViewCategory::route('/{record}'),
        ];
    }
}