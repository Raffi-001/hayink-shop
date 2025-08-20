<?php

namespace App\Filament\Resources;

use App\Enums\ProductInfoType;
use App\Filament\Resources\ProductInfoBlockResource\Pages;
use App\Filament\Resources\ProductInfoBlockResource\RelationManagers;
use App\Models\ProductInfoBlock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductInfoBlockResource extends Resource
{
    protected static ?string $model = ProductInfoBlock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options(ProductInfoType::class),
                Forms\Components\TextInput::make('title')
                    ->label('handle')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductInfoBlocks::route('/'),
            'create' => Pages\CreateProductInfoBlock::route('/create'),
            'edit' => Pages\EditProductInfoBlock::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }
}
