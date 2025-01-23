<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayOnlineController extends Controller
{
    public function validatePaymentForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'service' => 'required',
            'sum' => 'numeric|min:1'
        ], [
            'service.required' => 'Заполните поле услуга',
            'sum.min' => 'Сумма должна быть не менне 1 руб.'
        ]);
        $rateSetting = Setting::where('group', 'rates')->where('name', 'kzt')->firstOrFail();
        $now = Carbon::now()->format('Y-m-d');
        $rateSettingUpdated = Carbon::parse($rateSetting->updated_at)->format('Y-m-d');
        if($rateSetting->value && $now === $rateSettingUpdated) {
            $rate_kzt = $rateSetting -> value;
        } else {
            $rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'),true);
            $rateSetting ->value = $rates['Valute']['KZT']['Value'];
            $rateSetting->save();
        }
    $data = [
        'sum_ru' => (int) $request->get('sum'),
        'sum_not_ru' =>  (int) ceil((int) $request->get('sum') / ($rateSetting->value / 100)),
        'service' => $request->get('service'),
        'email' => $request->get('email')

    ];
        if(Setting::where('group', 'payment') -> where('name', 'currency_ru')->exists()) {
            $currency_ru = Setting::where('group', 'payment') -> where('name', 'currency_ru')->first();
            $data['currency_ru'] = $currency_ru->value;
        } else {
            $data['currency_ru'] = 'руб';
        }
        if(Setting::where('group', 'payment') -> where('name', 'currency_not_ru')->exists()) {
            $currency_not_ru = Setting::where('group', 'payment') -> where('name', 'currency_not_ru')->first();
            $data['currency_not_ru'] = $currency_not_ru->value;
        } else {
            $data['currency_not_ru'] = 'тенге';
        }
      return $data;
    }
}
