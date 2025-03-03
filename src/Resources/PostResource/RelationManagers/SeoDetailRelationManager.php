<?php

namespace Firefly\FilamentBlog\Resources\PostResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Firefly\FilamentBlog\Models\SeoDetail;

class SeoDetailRelationManager extends RelationManager
{
    protected static string $relationship = 'seoDetail';

    public function form(Form $form): Form
    {
        return $form
            ->schema(SeoDetail::getForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-blog::filament-blog.title')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('filament-blog::filament-blog.description')),
                Tables\Columns\TextColumn::make('keywords')
                    ->label(__('filament-blog::filament-blog.keywords'))
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}