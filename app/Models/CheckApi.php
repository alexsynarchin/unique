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

    public function accounts()
    {
        return $this->hasMany(ApiAccount::class, 'api_id', 'id');
    }
}
