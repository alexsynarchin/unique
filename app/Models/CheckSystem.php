<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CheckSystem extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'description', 'price_ru', 'price_not_ru', 'api_id', 'symbols_count',  'report_file'];

    protected $appends = ['logo'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('check-systems')
            ->singleFile()
            ->useDisk('check-system');
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
        $image = $this ->getFirstMediaUrl('check-systems');
        return $image;
    }

    public function checkApi()
    {
        return $this->belongsTo(CheckApi::class, 'api_id');
    }

}
