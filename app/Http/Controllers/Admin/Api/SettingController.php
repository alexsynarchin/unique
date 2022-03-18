<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function updateCommon(Request $request)
    {
        $exists= Setting::where('group',$request->get('group'))->where('name',$request->get('name'))->exists();
        if(!$exists) {
            if($request ->get('value')){
                $setting = Setting::create($request->all());
                return $setting;
            } else {
                return 'null';
            }

        } else {
            $setting = Setting::where('group', $request->get('group'))->where('name',$request->get('name')) ->firstOrFail();
            $setting ->update($request->all());
            return $setting;
        }
    }

    public function getCommon(Request $request)
    {
        $settings = Setting::where('group','common') -> get();
        $values =[];
        foreach ($settings as $setting) {
            $values[$setting->name] = $setting ->value;
        }
        return json_encode($values);
    }
}
