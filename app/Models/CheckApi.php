<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckApi extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $casts = [
        'accounts' => 'array'
    ];
}
