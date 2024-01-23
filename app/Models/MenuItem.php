<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MenuItem extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];


    // Define the table associated with the model
    protected $table = 'menu_items';

    // Define the primary key field
    protected $primaryKey = 'id';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'category',
        'image',
    ];

    // Define the relationship with the Restaurant model
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 200)
            ->nonQueued();
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 50, 50)
            ->nonQueued();
    }
    public function getImageUrl(string $conversion): string
    {
        if (!$this->media->isEmpty())
            ray($this->media->first()->getUrl($conversion));

        return ($this->media->isNotEmpty())
            ? $this->media->first()->getUrl($conversion)
            : '/media/default/conversions/default-' . $conversion . '.jpg';
    }
}
