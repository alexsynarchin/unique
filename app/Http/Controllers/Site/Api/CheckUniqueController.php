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

    public function checkFile(Request $request)
    {
        $file = $request->file('file');
        $size = $file->getSize();
        $source = $file;

        $phpWord = \PhpOffice\PhpWord\IOFactory::load($file,'MsDoc');
// read source
        $sections = $phpWord->getSections();
        $text = '';
        foreach ($sections as $key => $value) {
            $sectionElement = $value->getElements();
            foreach ($sectionElement as $elementKey => $elementValue) {
                if ($elementValue instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    $secondSectionElement = $elementValue->getElements();
                    foreach ($secondSectionElement as $secondSectionElementKey => $secondSectionElementValue) {
                        if ($secondSectionElementValue instanceof \PhpOffice\PhpWord\Element\Text) {
                            $text .= $secondSectionElementValue->getText();

                        }
                    }
                }
            }
        }
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
