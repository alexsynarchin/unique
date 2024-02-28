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
        'uid', 'data', 'check_unique_id', 'system_id', 'error', 'error_code', 'api_id'
    ];
    protected $appends = [
        'formatted_date',
    ];
    protected $casts = [
        'result' => 'boolean',
        'data' => 'array',
        'params' => 'array'
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

    public function uniqueOrder()
    {
        return $this->belongsTo(UniqueOrder::class, 'unique_order_id');
    }
    public function checkUnique()
    {
        return $this->belongsTo(CheckUnique::class, 'check_unique_id');
    }

    public function getSymbolsCountAttribute() {
        $symbols_count = 0;
        if($this->check_unique_id) {
            $text_symbols = $this->checkUnique->symbolsCount;
            $system_symbols = $this->checkSystem->symbols_count;
            $symbols_count = $text_symbols;
            if($text_symbols > $system_symbols) {
                $symbols_count = $system_symbols;
            }
        }

        return $symbols_count;
    }
}
