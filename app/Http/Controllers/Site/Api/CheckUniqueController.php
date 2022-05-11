<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use Illuminate\Http\Request;


class CheckUniqueController extends Controller
{
    public function check(Request $request)
    {
        $words_count = count(preg_split('/\s+/', $request->get('text')));
        $symbols_count = strip_tags($request->get('text'));
        $symbols_count = preg_replace('/\s+/', '',  $symbols_count);
        $symbols_count = iconv_strlen($symbols_count);
        $sentenceCount = substr_count($request->get('text'),'.') + substr_count($request->get('text'),'!')+ substr_count($request->get('text'),'?');
        $textParams = [
            'symbolsCount' => $symbols_count,
            'wordsCount' => $words_count,
            'plainText' => $request->get('text'),
            'sentenceCount' => $sentenceCount,
            'size' => 0,
            'pages' => 0,
        ];
        return $textParams;
    }

    public function checkFile(Request $request)
    {
        //application/vnd.openxmlformats-officedocument.wordprocessingml.document
        //application/msword
        $file = $request->file('file');

        $size = $file->getSize();
        $source = $file;
        $text = '';
        if($request->file('file')->getClientMimeType() === 'application/msword') {
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($file,'MsDoc');
// read source

            $sections = $phpWord->getSections();
            foreach ($sections as $s) {
                $els = $s->getElements();
                foreach ($els as $e) {
                    if(!$e instanceof \PhpOffice\PhpWord\Element\Text){
                        continue;
                    }
                    $text .= $e->getText();

                }
            }
        }  elseif ($request->file('file')->getClientMimeType() === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            $objReader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');

            $phpWord = $objReader->load($source);
            $sections = $phpWord->getSections();

            foreach ($sections as $s) {
                $els = $s->getElements();
                foreach ($els as $e) {
                    if (!$e instanceof \PhpOffice\PhpWord\Element\Text) {
                        continue;
                    }
                    $text .= $e->getText();

                }
            }
        }



       // echo mb_convert_encoding( $text, 'UTF-8', 'UTF-16LE' );;
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
            'plainText' => $text,
            'size' => $size,
            'pages' => $pages,
        ];
        return $textParams;
    }

    public function getApiTextRu($uid, $userkey)
    {

        $TextRuApi= new \TextRuApi\TextRuApi($userkey);

        sleep(15);
        //Получаете результат проверки
        $jsonvisible = 'detail';
        $return = $TextRuApi->get($uid, $jsonvisible);
        return $return;
    }

    public function makeReport(Request $request)
    {
        $report = CheckUnique::create($request->all());
        $url = route('report', $report->id);
        return $url;
    }
}
