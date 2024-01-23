<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Restaurant extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    // Define the table associated with the model
    protected $table = 'restaurants';

    protected $guarded = [];

    // Define the primary key field
    protected $primaryKey = 'id';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'location',
        'contactInformation',
        'operatingHours',
    ];

    // Define the relationship with Table and Menu Item models
    public function tables()
    {
        return $this->hasMany(Table::class, 'id');
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'id');
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
