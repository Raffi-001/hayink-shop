<?php
namespace App\Lunar\Admin\Filament\Extensions;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Lunar\Admin\Support\Extending\ResourceExtension;


class ProductListExtension extends ResourceExtension
{
    public function extendTable(Table $table): Table
    {
        return $table->filters([
            ...$table->getFilters(),

            SelectFilter::make('product_type_id')
                ->label('Product Type')
                ->relationship('productType', 'name'),

            TernaryFilter::make('published')
                ->label('Published Status')
                ->boolean()
                ->trueLabel('Published')
                ->falseLabel('Unpublished')
                ->nullable()
                ->queries(
                    true: fn (Builder $query) => $query->where('status', 'published'),
                    false: fn (Builder $query) => $query->where('status', 'draft'),
                    blank: fn (Builder $query) => $query
                ),

        ])->actions([
            ActionGroup::make([
                \Filament\Tables\Actions\Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status !== 'published')
                    ->action(fn ($record) => $record->update(['status' => 'published'])),

                \Filament\Tables\Actions\Action::make('draft')
                    ->label('Mark as Draft')
                    ->icon('heroicon-o-pencil')
                    ->color('warning')
                    ->visible(fn ($record) => $record->status !== 'draft')
                    ->action(fn ($record) => $record->update(['status' => 'draft'])),
            ])
        ])->bulkActions([
            \Filament\Tables\Actions\BulkAction::make('bulk_publish')
                ->label('Publish Selected')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(fn (array $records) => collect($records)
                    ->each(fn ($record) => $record->update(['status' => 'published']))
                ),

            \Filament\Tables\Actions\BulkAction::make('bulk_draft')
                ->label('Mark Selected as Draft')
                ->icon('heroicon-o-pencil')
                ->color('warning')
                ->action(fn (array $records) => collect($records)
                    ->each(fn ($record) => $record->update(['status' => 'draft']))
                ),
        ]);
    }
}
