<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class CheckUnique extends Model
{
    use HasFactory;
    protected $fillable= [
        'pages', 'wordsCount',
        'symbolsCount', 'sentenceCount', 'type',
        'plainText', 'email'
    ];

    protected $appends = [
        'formatted_date'
    ];
    public function reports()
    {
        return $this->hasMany(Report::class, 'check_unique_id');
    }

    public function getFormattedDateAttribute()
    {
        $date = $this->attributes['created_at'];
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i');
        return $date;
    }

}
