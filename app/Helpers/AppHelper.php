<?php

namespace App\Helpers;

use App\Models\Setting;

class AppHelper
{
    public static function setMailConfig()
    {
        $mail = Setting::where('group', 'smtp')->pluck('value', 'name');
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
