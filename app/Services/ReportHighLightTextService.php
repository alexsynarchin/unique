<?php

namespace App\Services;

class ReportHighLightTextService
{
    public function highLightText($data)
    {
        $plagiats_arr = [];
        if(count($data['urls']) === 0) {
            return $data['clear_text'];
        }
        foreach ($data['urls'] as $item) {
           array_push($plagiats_arr, $item['plagiat']);
        }

        dd($data['clear_text']);
        $index = array_keys($plagiats_arr, max($plagiats_arr))[0];
        $textArr  = $this->textToArray($data['clear_text']);
        $wordsIndexesArr = explode(' ', $data['urls'][$index]['words']);
        foreach ($wordsIndexesArr as $item) {
            $textArr[$item] = '<span class="highlight--red">' . $textArr[$item] . '</span>';
        }
        $text = implode(" ", $textArr);
        return $text;
    }

    private function textToArray($string)
    {
        $separator = " \t\n";
        $array_words = [];
        $tok = strtok($string, $separator);
        while($tok) {
            $array_words[] = $tok;
            $tok = strtok(" \t\n");
        }
        return $array_words;
    }
}
