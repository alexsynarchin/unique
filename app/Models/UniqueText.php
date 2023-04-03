<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueText extends Model
{
    use HasFactory;
    protected $fillable = ['text'];
}
