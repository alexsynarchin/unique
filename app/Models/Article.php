<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable =[
        'title', 'published', 'slug',
        'date', 'published'
    ];

    protected $appends = ['preview', 'description'];

    protected $casts = [
        'published' => 'boolean',
        'date' => 'date:d.m.Y',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('articles')
            ->singleFile()
            ->useDisk('article');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(550)
            ->height(250)
            ->crop(Manipulations::CROP_CENTER, 550, 250)
            ->nonQueued();
    }

    public function getPreviewAttribute()
    {
        $image = $this ->getFirstMediaUrl('articles', 'thumb');
        return $image;
    }

    public function getDescriptionAttribute()
    {
        $text = html_entity_decode($this->content->text);
        $text = strip_tags($text);
        $text = substr($text, 0, 300);
        $text = rtrim($text, "!,.-");
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . '...';

        return $text;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function seo()
    {
        return $this->morphOne(Seo::class,'pageable');
    }

    public function content()
    {
        return $this->morphOne(PageContent::class,'pageable');
    }

}
