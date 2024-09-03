<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\AppHelper;

class ContactController extends Controller
{
    public function consultation(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
          //'token' => 'required',
             'email' => 'nullable|email'
        ], [
            'token.required' => 'Вы не прошлия проверку. Я не робот.'
        ]);

        $order = Order::create($request->all());
        $order -> status = 1;
        $order -> save();
        $exists= Setting::where('group', 'common')->where('name','email_admin')->exists();
        if($exists) {
            $setting = Setting::where('group', 'common')->where('name','email_admin') ->firstOrFail();
            $email = $setting -> value;
            $email = explode(',', $email);


        } else {
            $email = ['alexsynarchin@gmail.com'];
        }
        foreach ($email as $recipient) {
            $recipient = str_replace(" ", '', $recipient);
            AppHelper::setMailConfig();
            try {
                Mail::to(trim($recipient))->send(new ContactMail($order));
            } catch (\Exception $e) {
                return  ['error' => 'Произошла ошибка, обратитесь к администратору сайта'];
            }

        }
        return $request->all();
    }
}
