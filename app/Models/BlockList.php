<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockList extends Model
{
    use HasFactory;
    protected $fillable =[
        'title', 'type', 'list'
    ];

    protected $casts = [
        'list' => 'array'
    ];
}
