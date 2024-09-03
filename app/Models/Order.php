<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'status', 'comment', 'email', 'currency', 'type'
    ];
    protected $casts = [
        'created_at' => 'date: d.m.Y',
    ];

    protected $appends = [
        'status_title', 'order_type'
    ];

    public function getStatusTitleAttribute()
    {
        $title = '';
        $status = $this->status;
        switch ($status) {
            case 1:
                $title = 'Не просмотрена';
                break;
            case 2:
                $title = 'Просмотрена';
                break;
        }
        return $title;
    }

    public function getOrderTypeAttribute()
    {
        $title = '';
        $type = $this->type;
        switch ($type) {
            case 1:
                $title = 'Заявка на консультацию';
                break;
            case 2:
                $title = 'Подключение к системе';
                break;
        }
        return $title;
    }
}
