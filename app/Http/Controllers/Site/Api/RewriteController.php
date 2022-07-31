<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Models\Rewrite;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RewriteController extends Controller
{
    public function order(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'plain_text' => 'required',
            'symbolsCount' => 'numeric|min:100|max:150000',
            'promocode' => ['nullable',
                function ($attribute, $value, $fail) use ($request) {
                    $exists =  PromoCode::where('name', $request->get('promocode'))->exists();
                    if (!$exists) {
                        $fail('Данный промокод не сущетсвует');
                    }
                },
                function ($attribute, $value, $fail) use ($request) {
                    if(PromoCode::where('name', $request->get('promocode'))->exists()){
                        $promo_code  = PromoCode::where('name', $request->get('promocode')) ->firstOrFail();
                        if($promo_code->max_count < 1) {
                            $fail('Данный промокод не может больше  использоваться');
                        }
                    }

                },
                function ($attribute, $value, $fail) use ($request) {
                    if(PromoCode::where('name', $request->get('promocode'))->exists()){
                        $promo_code  = PromoCode::where('name', $request->get('promocode')) ->firstOrFail();
                        $date1 = Carbon::parse(date('Y-m-d'));
                        $date2 = Carbon::parse(date('Y-m-d', strtotime($promo_code->end_time)));
                        if($date1> $date2) {
                            $fail('Данный промокод не может больше  использоваться');
                        }
                    }

                },
                function ($attribute, $value, $fail) use ($request) {
                    if(PromoCode::where('name', $request->get('promocode'))->exists()){
                        $promo_code  = PromoCode::where('name', $request->get('promocode')) ->firstOrFail();
                        $date1 = Carbon::parse(date('Y-m-d'));
                        $date2 = Carbon::parse(date('Y-m-d', strtotime($promo_code->start_time)));
                        if($date2 > $date1) {
                            $fail('Данный промокод не может использоваться');
                        }
                    }

                },],
            ],[
            'symbolsCount.min' => 'Количество символов должно быть больше 100',
            'symbolsCount.max' => 'Количество символов не может быть больше 1500000',
            'email.required' => 'Введите ваш e-mail',
            'plain_text.required' => 'Введите текст на рерайт или загрузите документ',
            'promocode.exists,name' => 'Промокод не найден',
            'name' => 'Введите ваше имя'
        ]);
        $rewrite = Rewrite::create($request->all());

        $filename = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs(
            'rewrites/' . $rewrite->id, $filename
        );
        if($request->has('promocode') && $request->get('promocode')) {
            $promo_code = PromoCode::where('name', $request->get('promocode'))->firstOrFail();
            $promo_code -> max_count = $promo_code -> max_count-1;
            $promo_code -> save();
            $rewrite ->promoCode()->associate($promo_code);
        }
        $rewrite->filename = $filename;
        $rewrite->save();

        return $rewrite;
    }
}
