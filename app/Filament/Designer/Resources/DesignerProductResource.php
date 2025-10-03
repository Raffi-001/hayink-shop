<?php

namespace App\Filament\Designer\Resources;

use App\Filament\Designer\Resources\DesignerProductResource\Pages;
use App\Filament\Designer\Resources\DesignerProductResource\RelationManagers;
use App\Filament\Forms\Components\TDesigner;
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
                // Step 1: Always visible
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('tshirt_type')
                    ->label('Product Type')
                    ->options([
                        'regular'   => 'Tshirt',
                        'oversize'  => 'Tshirt Oversize',
                        'hoodie'    => 'Hoodie',
                        'hat'       => 'Hat',
                    ])
                    ->disableOptionWhen(fn ($value): bool => in_array($value, ['hoodie', 'hat']))
                    ->required()
                    ->reactive()
                    ->native(false),

                // Step 2: Visible only after selecting a type
                Forms\Components\CheckboxList::make('colors')
                    ->label('Colors')
                    ->options([
                        'black'    => 'Black',
                        'white'    => 'White',
                        'offwhite' => 'Offwhite',
                    ])
                    ->columns(3)
                    ->reactive()
                    ->visible(fn (callable $get) => filled($get('tshirt_type'))),

                // Step 3: Visible only when both type + colors are set
                Forms\Components\Fieldset::make('mockup_designs')
                    ->label('T-Shirt Designer(s)')
                    ->schema(function (callable $get) {
                        $schema = [];

                        $type = $get('tshirt_type');
                        $colors = $get('colors') ?? [];

                        if (! $type || empty($colors)) {
                            return $schema;
                        }

                        foreach ($colors as $color) {
                            $front = match ([$type, $color]) {
                                ['regular', 'black']    => 'http://hi.test/fpd-js/images/t-regular-black-front.png',
                                ['regular', 'white']    => 'http://hi.test/fpd-js/images/t-regular-white-front.png',
                                ['regular', 'offwhite'] => 'http://hi.test/fpd-js/images/t-regular-offwhite-front.png',

                                ['oversize', 'black']    => 'http://hi.test/fpd-js/images/t-oversize-black-front.png',
                                ['oversize', 'white']    => 'http://hi.test/fpd-js/images/t-oversized-white-front.png',
                                ['oversize', 'offwhite'] => 'http://hi.test/fpd-js/images/t-oversized-offwhite-front.png',

                                default => null,
                            };

                            $back = match ([$type, $color]) {
                                ['regular', 'black']    => 'http://hi.test/fpd-js/images/t-regular-black-back.png',
                                ['regular', 'white']    => 'http://hi.test/fpd-js/images/t-regular-white-back.png',
                                ['regular', 'offwhite'] => 'http://hi.test/fpd-js/images/t-regular-offwhite-back.png',

                                ['oversize', 'black']    => 'http://hi.test/fpd-js/images/t-oversize-black-back.png',
                                ['oversize', 'white']    => 'http://hi.test/fpd-js/images/t-oversized-white-back.png',
                                ['oversize', 'offwhite'] => 'http://hi.test/fpd-js/images/t-oversized-offwhite-back.png',

                                default => null,
                            };

                            if ($front) {
                                $schema[] = TDesigner::make("mockups.{$type}.{$color}.front")
                                    ->label(ucfirst($type) . ' - ' . ucfirst($color) . ' (Front)')
                                    ->background($front)
                                    ->dehydrated(true)
                                    ->default([]);
                            }

                            if ($back) {
                                $schema[] = TDesigner::make("mockups.{$type}.{$color}.back")
                                    ->label(ucfirst($type) . ' - ' . ucfirst($color) . ' (Back)')
                                    ->background($back)
                                    ->dehydrated(true)
                                    ->default([]);
                            }
                        }

                        return $schema;
                    })
                    ->columns(1)
                    ->visible(fn (callable $get) => filled($get('tshirt_type')) && filled($get('colors'))),

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
            // 'design' => Pages\DesignTool::route('/design'),
        ];
    }
}
