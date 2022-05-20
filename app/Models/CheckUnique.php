<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CheckUnique extends Model
{
    use HasFactory;
    public function reports()
    {
        $this->hasMany(Report::class, 'check_unique_id');
    }

}
