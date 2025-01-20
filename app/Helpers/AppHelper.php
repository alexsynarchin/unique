<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;

class AppHelper
{
    public static function setMailConfig()
    {
        $smtp_group = Setting::where('name', 'smtp_main')->first();
        $mail = Setting::where('group', $smtp_group->value)->pluck('value', 'name');

        $mailConfig = array(
            'transport' => 'smtp',
            'host'       => $mail['host'],
            'port'       => $mail['port'],
            'encryption' => $mail['encryption'],
            'username'   => $mail['email'],
            'password'   => $mail['password']

        );
        config(['mail.mailers.smtp' => $mailConfig]);

    }
}
