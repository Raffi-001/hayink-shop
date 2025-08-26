<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomProductRequestResource\Pages;
use App\Filament\Resources\CustomProductRequestResource\RelationManagers;
use App\Models\CustomProductRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Novadaemon\FilamentPrettyJson\Form\PrettyJsonField;

class CustomProductRequestResource extends Resource
{
    protected static ?string $model = CustomProductRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\SpatieMediaLibraryFileUpload::make('design')
                    ->previewable()
                    ->collection('designs'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('regions')
                    ->columnSpanFull(),
                // PrettyJsonField::make('regions')
                //     ->columnSpanFull(),
                Forms\Components\Textarea::make('sizes')
                    ->columnSpanFull(),

                // PrettyJsonField::make('sizes')
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('design')
                    ->collection('designs'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
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
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            SpatieMediaLibraryImageEntry::make('image')
                ->collection('designs'),
            Grid::make([
               'sm' => 3,
            ])->schema([
                TextEntry::make('name'),
                TextEntry::make('email'),
                TextEntry::make('phone_number'),
            ]),

            RepeatableEntry::make('sizes')
                ->schema([
                    TextEntry::make('color'),
                    TextEntry::make('size'),
                    TextEntry::make('qty'),
                ])
                ->columns(3)
        ])->columns(1);
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
            'index' => Pages\ListCustomProductRequests::route('/'),
            'create' => Pages\CreateCustomProductRequest::route('/create'),
            'edit' => Pages\EditCustomProductRequest::route('/{record}/edit'),
            'view' => Pages\ViewCustomProductRequest::route('/{record}'),
        ];
    }
}
