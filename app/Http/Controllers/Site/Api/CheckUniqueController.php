<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckUniqueController extends Controller
{
    public function check(Request $request)
    {
        $symbols_count = strip_tags($request->get('text'));
        $symbols_count = preg_replace('/\s+/', '',  $symbols_count);
        $symbols_count = iconv_strlen($symbols_count);
        $words_count = str_word_count($request->get('text'));
        $textParams = [
            'symbolsCount' => $symbols_count,
            'wordsCount' => $words_count,
            'sentenceCount' => 0,
            'size' => 0,
            'pages' => 0,
        ];
        return $textParams;
    }
}
