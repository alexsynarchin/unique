<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayOnlineController extends Controller
{
    public function index()
    {
        $seo = [
            'title' => 'Оплата услуг сайта Проверить-уникальность.рф',
            'description' => 'На данной странице вы можете оплатить услуги нашего сайта Проверить-уникальность.рф',
            'keywords' => 'Оплата услуг сайта Проверить-уникальность.рф'
        ];
        return view('site.pay-online.index', ['seo' => $seo]);
    }
}
