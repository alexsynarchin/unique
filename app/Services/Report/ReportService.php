<?php
namespace App\Services\Report;
class ReportService
{
    public function calcTextParams($text)
    {
        $symbols_count = strip_tags($text);
        $symbols_count = preg_replace('/\s+/', '',  $symbols_count);
        $symbols_count = iconv_strlen($symbols_count);
        $words_count = preg_split('/\s+/',$text);
        $words_count = sizeof($words_count);
        $pages = (int) ($symbols_count/1750);
        if ($pages === 0) {
            $pages = 1;
        }
        $textParams = [
            'symbols_count' => $symbols_count,
            'wordsCount' => $words_count,
            'sentenceCount' => 0,
            'pages' => $pages,
        ];
        return $textParams;
    }
}
