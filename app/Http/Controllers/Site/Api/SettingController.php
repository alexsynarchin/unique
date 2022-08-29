<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSetting($group, $name)
    {
        $value = '';

        if(Setting::where('group', $group)->where('name', $name)->exists()) {
            $setting = Setting::where('group', $group)->where('name', $name)->first();
            $value = $setting -> value;
        }

        return $value;
    }
}
