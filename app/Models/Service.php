<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title', 'description', 'price',
    ];

    protected $appends = ['logo'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('services')
            ->singleFile()
            ->useDisk('service');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->crop(Manipulations::CROP_CENTER, 200, 200)
            ->nonQueued();
    }

    public function getLogoAttribute()
    {
        $image = $this ->getFirstMediaUrl('services');
        return $image;
    }
}
