<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewrite extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'text_params', 'filename',
        'price', 'date', 'status', 'plain_text',
        'promo_id'
    ];

    protected $casts = [
        'date' => 'date: d.m.Y',
        'text_params' => 'array',
    ];

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_id');
    }
}
