<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlockList extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable =[
        'title', 'type', 'list', 'options'
    ];

    protected $casts = [
        'list' => 'array',
        'options' => 'array'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('block-lists')
            ->useDisk('block-list');
    }


}
