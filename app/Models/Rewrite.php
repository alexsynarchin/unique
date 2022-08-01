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
        'comment', 'promo_id'
    ];

    protected $casts = [
        'date' => 'date: d.m.Y',
        'text_params' => 'array',
    ];

    protected $appends = [
        'status_title'
    ];

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_id');
    }

    public function getStatusTitleAttribute()
    {
        $title = '';
        $status = $this->attributes['status'];
        switch ($status) {
            case 0:
               $title = 'Не просмотрена';
                break;
            case 1:
                $title = 'Новая';
                break;
            case 2:
                $title = 'В работе"';
                break;
            case 3:
                $title = 'Завершена';
                break;
        }
    }
}
