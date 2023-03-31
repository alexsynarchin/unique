<?php

namespace App\Services;

class ReportHighLightTextService
{
    public function highLightText($data, $type, $index=-1)
    {
        $text ='';
       if($data === 'text.ru') {
           $text = $this->highLightTextRu($data, $index);
       } else if($type === 'content-watch.ru') {
           $text = $this->highLightContentWatch($data, $index);
       } else if($type === 'textovod.ru') {
           $text = $this->highLightTextovod($data, $index);
       }
      return $text;
    }

    private function highLightContentWatch($data, $index)
    {

        if(count($data['urls']) === 0) {
            return $data['clear_text'];
        }
        $highlight = [];

        if($index === -1) {
            $highlight = $data['highlight'];
        } else {
            $highlight = $data['urls'][$index]['highlight'];

        }
        $textArr = [];
        $textArr  = $this->textToArray($data['clear_text']);
        //dd($highlight);
        foreach ($highlight as $key => $item )
        {
            if(is_array($item)) {

                $textArr[ (int) $item[0]] =  '<span class="highlight--red">' . ($textArr[(int) $item[0]] ?? '') ;

                $textArr[ (int) $item[1]] =  ($textArr[(int) $item[1]] ?? '') . '</span>';
            } else {

                $textArr[ (int) $item] =  '<span class="highlight--red">' . $textArr[(int) $item] . '</span>';
            }

        }
        $text = implode(" ", $textArr);
        return $text;
    }
    private function highLightTextRu($data, $index) {
        $plagiats_arr = [];
        if(count($data['urls']) === 0) {
            return $data['clear_text'];
        }
        foreach ($data['urls'] as $item) {
            $plagiats_arr[] = $item['plagiat'];
        }

        if($index === -1) {
            $index = array_keys($plagiats_arr, max($plagiats_arr))[0];
        }

        $textArr  = $this->textToArray($data['clear_text']);
        $wordsIndexesArr = explode(' ', $data['urls'][$index]['words']);

        foreach ($wordsIndexesArr as $item) {
            if(isset($textArr[$item])) {
                $textArr[$item] = '<span class="highlight--red">' . $textArr[$item] . '</span>';
            }

        }
        $text = implode(" ", $textArr);
        return $text;
    }

    private function highLightTextovod($data, $index)
    {

        if($index === -1) {
            $highlight = $data['position'];
        } else {
            $highlight = $data['urls'][$index]['position'];

        }
        $textArr = $this->textToArray($data['clear_text']);
        $wordsIndexesArr = explode(',',$highlight);

        foreach ($wordsIndexesArr as $item) {
            if(isset($textArr[$item])) {
                $textArr[$item] = '<span class="highlight--red">' . $textArr[$item] . '</span>';
            }

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
