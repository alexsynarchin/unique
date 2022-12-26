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
        'uid', 'data', 'check_unique_id', 'system_id'
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
        $date = Carbon::create($this->attributes['created_at'])->addHours(5);
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i');
        return $date;
    }

    public function checkSystem()
    {
        return $this->belongsTo(CheckSystem::class, 'system_id');
    }

    public function checkUnique()
    {
        return $this->belongsTo(CheckUnique::class, 'check_unique_id');
    }
}
