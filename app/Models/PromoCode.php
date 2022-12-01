<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $casts = [
        'start_time'  => 'date:d-m-Y',
        'end_time' => 'date:d-m-Y',
    ];

    protected $fillable = [
        'name', 'discount_type', 'discount', 'max_count',
        'end_time', 'start_time'
    ];
}
