<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $fillable =[
        'title', 'description', 'keywords'
    ];
    public function pageable()
    {
        return $this->morphTo();
    }
}
