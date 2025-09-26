<?php

namespace App\Filament\Designer\Resources;

use App\Filament\Designer\Resources\DesignerProductResource\Pages;
use App\Filament\Designer\Resources\DesignerProductResource\RelationManagers;
use App\Models\DesignerProduct;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DesignerProductResource extends Resource
{
    protected static ?string $model = DesignerProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'My Products';

    protected static ?string $label = 'Product';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description'),

                // ✅ FileUpload for design images
                // FileUpload::make('design_uploads')
                //     ->label('Upload Design Images')
                //     ->image()
                //     ->multiple()
                //     ->directory('designs')
                //     ->visibility('public')
                //     ->reactive()
                //     ->afterStateUpdated(function ($state, $livewire) {
                //         if (!empty($state)) {
                //             // $urls = collect($state)->map(fn ($path) => \Storage::url($path))->all();

                //             $urls = collect($state)
                //                 ->map(fn ($path) => \Storage::url($path))
                //                 ->values() // 👈 reset keys so it's a clean array
                //                 ->all();

                //             // Emit Livewire event (NOT browser event)
                //             $livewire->dispatch('fpd-add-images', urls: $urls);
                //         }
                //     }),

                SpatieMediaLibraryFileUpload::make('design_uploads')
                    ->label('Upload Design Images')
                    ->collection('design_uploads')
                    ->multiple()
                    ->image()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $livewire, $record) {
                        if (! $record) {
                            dd('noooo');
                            // No model yet (create form), skip here
                            return;
                        }

                        // ✅ Get public URLs from Spatie Media Library
                        $urls = $record->getMedia('design_uploads')
                            ->map->getUrl()
                            ->values()
                            ->all();

                        if (! empty($urls)) {
                            $livewire->dispatch('fpd-add-images', urls: $urls);
                        }
                    }),



                // ✅ Your custom FPD field
                Forms\Components\Field::make('fpd_design')
                    ->label('Designer')
                    ->columnSpan('full')
                    ->view('forms.components.fpd-designer') // Blade you showed earlier
                    ->dehydrated(true)                       // send state on save
                    ->default([]),
            ])
            ->columns(1);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
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
                // Tables\Actions\Action::make('Design')
                //     ->button()
                //     ->color('success')
                //     ->url(Pages\DesignTool::getUrl())
                //     ->icon('heroicon-o-sparkles'),
                Tables\Actions\EditAction::make()
                    ->color('success')
                    ->icon('heroicon-o-sparkles'),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDesignerProducts::route('/'),
            'design' => Pages\DesignTool::route('/design'),
        ];
    }
}
