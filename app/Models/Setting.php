<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public static function get($name)
    {
        $setting = new self();
        $entry = $setting->where('group','common') -> where('name', $name)->first();
        if (!$entry) {
            return;
        }
        return $entry->value;
    }
    protected $fillable =[
        'name', 'value', 'group',
    ];
}
