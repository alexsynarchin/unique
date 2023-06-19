<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use Illuminate\Http\Request;
use Cookie;

class CheckReportController extends Controller
{
    public function show($slug)
    {
        $check_unique = CheckUnique::where('slug', $slug)->firstOrFail(['id']);

        //vk_app_51581157
      // Cookie::queue('vk_app_51554125','',10);
        //Cookie::queue(Cookie::forget('vk_app_51581291'));
        return view('site.check-report.show', ['id' => $check_unique->id]);
    }


}
