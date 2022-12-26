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
        'comment', 'promo_id', 'phone'
    ];

    protected $casts = [
        'date' => 'date: d.m.Y',
        'text_params' => 'array',
    ];

    protected $appends = [
        'status_title', 'file_link'
    ];

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_id');
    }

    public function getStatusTitleAttribute()
    {
        $title = '';
        $status = $this->status;
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
        return $title;
    }

    public function getFileLinkAttribute()
    {
        $link = '';
        if($this->filename) {
            $link = '/storage/rewrites/' . $this->id .'/' . $this->filename;
        }
        return $link;
    }
}
