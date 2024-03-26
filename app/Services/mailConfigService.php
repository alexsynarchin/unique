<?php

namespace App\Services;

use App\Models\Setting;

class mailConfigService
{
    public function generateConfig($name)
    {
        $mail = Setting::where('group', $name)->pluck('name', 'value');
        $mailConfig = array(
            'transport' => 'smtp',
            'host'       => $mail['host'],
            'port'       => $mail['port'],
            'encryption' => $mail['encryption'],
            'username'   => $mail['email'],
            'password'   => $mail['password']

        );

        return $mailConfig;
    }
}
