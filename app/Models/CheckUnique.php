<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CheckUnique extends Model
{
    use HasFactory;
    protected $fillable= [
        'pages', 'wordsCount',
        'symbolsCount', 'sentenceCount', 'type',
        'plainText', 'email'
    ];
    public function reports()
    {
        return $this->hasMany(Report::class, 'check_unique_id');
    }

}
