<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CheckUniqueController extends Controller
{
    public function check(Request $request)
    {
        //
        $userkey = '66607d4fbd0b0c47af9a02ed3045fff2';
        $TextRuApi= new \TextRuApi\TextRuApi($userkey);
        $result = $TextRuApi->add($request->get('text'));
        $uid = $result["text_uid"];
        dd($uid);
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

    public function checkFile(Request $request)
    {
        $file = $request->file('file');
        $size = $file->getSize();
        $source = $file;

        $phpWord = \PhpOffice\PhpWord\IOFactory::load($file,'MsDoc');
// read source

        $sections = $phpWord->getSections();
        $text = '';
        foreach ($sections as $s) {
            $els = $s->getElements();
            foreach ($els as $e) {
                if(!$e instanceof \PhpOffice\PhpWord\Element\Text){
                    continue;
                }
                $text .= $e->getText();
                $styles = $e->getParagraphStyle(); //do somethign witth the style
                $styles = $e->getFontStyle(); //do somethign witth the style
            }
        }
        echo mb_convert_encoding( $text, 'UTF-8', 'UTF-16LE' );;
       // $extracted_plaintext = mb_convert_encoding( $extracted_plaintext, 'UTF-8', 'UTF-16LE' );
        $symbols_count = strip_tags($text);
        $symbols_count = preg_replace('/\s+/', '',  $symbols_count);
        $symbols_count = iconv_strlen($symbols_count);
        $words_count = str_word_count($text);
        $pages = (int) ($words_count/200);
        if ($pages === 0) {
            $pages = 1;
        }
        $textParams = [
            'symbolsCount' => $symbols_count,
            'wordsCount' => $words_count,
            'sentenceCount' => 0,
            'size' => $size,
            'pages' => $pages,
        ];
        return $textParams;
    }
}
