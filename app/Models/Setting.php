<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable =[
        'name', 'value', 'group',
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('settings')
            ->useDisk('settings');
    }
    public static function get($group, $name)
    {
        $setting = new self();
        $entry = $setting->where('group',$group) -> where('name', $name)->first();
        if (!$entry) {
            return;
        }
        return $entry->value;
    }

    public static function set($group, $name, $value=null): bool
    {
        $setting = new self();
        $entry = $setting->where('group', 'common') ->where('name', $name)->firstOrFail();
        $entry->value = $value;
        $entry->saveOrFail();
        Config::set('key', $value);
        if (Config::get($group, $name) == $value) {
            return true;
        }
        return false;
    }
}


