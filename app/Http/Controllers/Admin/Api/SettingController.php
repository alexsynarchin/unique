<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaviconUploadRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SettingController extends Controller
{
    public function update(Request $request)
    {

        $settingArr = $request->all();
            if($settingArr['value'] === false) {

                $settingArr['value'] = 'false';


            }
        if($settingArr['value'] === true) {
            $settingArr['value'] = 'true';
        }
        if($settingArr['name'] && $settingArr['group']) {
            $setting = Setting::firstOrCreate([
                'group' => $settingArr['group'],
                'name' => $settingArr['name']
            ]);
            if(is_array($settingArr['value'])) {
                $settingArr['value']  = $this->uploadImage($settingArr['value'], $setting);
            }
            $setting->value = $settingArr['value'];
            $setting->save();
            return $setting;

        } else {
            return 'null';
        }
    }



    public function getSettings(Request $request)
    {
        $settings = Setting::where('group',$request->get('group')) -> get();
        $values =[];
        foreach ($settings as $setting) {
            $values[$setting->name] = $setting ->value;
        }
        return json_encode($values);
    }
    public function uploadFavicon(FaviconUploadRequest $request)
    {

        $validated = $request->validate();
        Storage::disk('local') ->put('/public/favicons/',$request->file('file'));
    }

    private function uploadImage($image , $setting)
    {
        $media = $setting ->addMediaFromBase64($image['link'])
            ->usingFileName($image['imageName'])
            ->toMediaCollection('settings');
        return $media->getUrl();
    }

    public function getSmtp(Request $request)
    {
        $isMain = Setting::where('name','smtp_main') -> first();
        $isMain = $isMain->value;
        $result = [];
        foreach ($request->get('groups') as $group) {
            $item = [
                'group' => $group,
                'isMain' => false,
            ];
            if($isMain == $group) {
                $item['isMain'] = true;
            }

            $result[] = $item;
        }
        return $result;
    }
}
