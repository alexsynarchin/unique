<?php

namespace App\Services;

use App\Models\Setting;

class mailConfigService
{
    public function generateConfig($name = 'smtp'): array
    {
        $smtp_group = Setting::where('name', 'smtp_main')->first();
        $mail = Setting::where('group', $smtp_group->value)->pluck('value', 'name');
        return array(
            'transport' => 'smtp',
            'host'       => $mail['host'],
            'port'       => $mail['port'],
            'encryption' => $mail['encryption'],
            'username'   => $mail['email'],
            'password'   => $mail['password']

        );
    }
}
