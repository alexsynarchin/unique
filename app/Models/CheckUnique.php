<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class CheckUnique extends Model
{
    use HasFactory;
    protected $fillable= [
        'pages', 'wordsCount',
        'symbolsCount', 'sentenceCount', 'type',
        'plainText', 'email', 'slug',
    ];

    protected $appends = [
        'formatted_date', 'file_link', 'status_title', 'type_title','sum'
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, 'check_unique_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class,'check_unique_service', 'check_unique_id','service_id');
    }

    public function orders()
    {
        return $this->hasMany(UniqueOrder::class, 'check_unique_id');
    }

    public function getFormattedDateAttribute()
    {
        $date = $this->attributes['created_at'];
        $date = Carbon::create($this->attributes['created_at'])->addHours(5);
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i');
        return $date;
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
            $link = '/storage/check_uniques/' . $this->id . '/' . $this->filename;
        }
        return $link;
    }

    public function getTypeTitleAttribute()
    {
        $title = '';
        switch($this->type) {
            case 1:
                $title = 'Авто';
                break;
            case 2:
                $title = 'Ручная';
                break;
            case 3:
                $title = 'Ручная/Авто';
                break;
        }

        return $title;
    }

    public function getSumAttribute()
    {
        $sum = $this->orders->sum('sum');
        return $sum;
    }
}
