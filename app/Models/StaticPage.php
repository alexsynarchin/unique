<?php

namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory, HasSlug;

    protected $fillable =[
        'name', 'published', 'slug',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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
