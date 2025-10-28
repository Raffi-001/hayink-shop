<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Lunar\FieldTypes\Text;
use Lunar\Models\Collection;
use Lunar\Models\CollectionGroup;
use Lunar\Models\Language;
use Lunar\Models\Url;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Artist extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::saved(function (Artist $artist) {
            if (! $artist->slug) {
                return;
            }

            $group = CollectionGroup::firstOrCreate(
                ['handle' => 'artists-collections'],
                ['name' => 'Artists Collections']
            );

            $collection = Collection::where('collection_group_id', $group->id)
                ->whereHas('urls', function ($query) use ($artist){
                    $query->where('slug', $artist->slug);
                })
                ->first();

            if (! $collection instanceof Collection) {
                $collection = Collection::create([
                    'collection_group_id' => $group->id,
                    'attribute_data' => [
                        'name' => new Text($artist->name),
                    ],
                ]);
            } else {
                $collection->update([
                    'attribute_data' => [
                        'name' => new Text($artist->name),
                    ],
                ]);
            }

            if (! $collection instanceof Collection) {
                \Log::error('Expected a Lunar Collection model, got:', ['type' => gettype($collection)]);
                return;
            }

            $language = Language::first();

            if ($language && !$collection->urls()
                    ->where('slug', $artist->slug)
                    ->where('language_id', $language->id)
                    ->exists()
            ) {
                // ✅ Ensure relationship creation with an actual model
                $collection->urls()->create([
                    'slug' => $artist->slug,
                    'language_id' => $language->id,
                    'default' => true,
                ]);
            }
        });
    }
}
