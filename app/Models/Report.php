<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;

class Report extends Model
{
    use HasFactory;

    protected $fillable= [
        'uid', 'pages', 'wordsCount',
        'symbolsCount', 'sentenceCount', 'type',
        'data', 'plainText', 'email'
    ];
    protected $appends = [
        'formatted_date'
    ];
    protected $casts = [
        'result' => 'boolean',
        'data' => 'array'
    ];
    public function getFormattedDateAttribute()
    {
        $date = $this->attributes['created_at'];
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i');
        return $date;
    }
}
