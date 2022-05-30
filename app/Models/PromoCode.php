<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $casts = [
        'start_time'  => 'date:m-d-Y',
        'end_time' => 'date:m-d-Y',
    ];

    protected $fillable = [
        'name', 'discount_type', 'discount', 'max_count',
        'end_time', 'start_time'
    ];
}
