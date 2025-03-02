<?php

namespace App\Services;

class ReportHighLightTextService
{
    public function highLightText($data, $type, $index=-1)
    {
        $text ='';
       if($type === 'text.ru') {
           $text = $this->highLightTextRu($data, $index);
       } else if($type === 'content-watch.ru') {
           $text = $this->highLightContentWatch($data, $index);
       } else if($type === 'textovod.ru') {
           $text = $this->highLightTextovod($data, $index);
       } else if ($type === 'advego.com') {
           $text = $this->highLightAdvego($data, $index);
       } else if($type === 'Retainer(Парсер Go (Google))') {
            $text = $this->highLightRetainer($data, $index);
       } else if ($type === 'Retainer(Парсер Go (Yahoo))') {
           $text = $this->highLightRetainer($data, $index);
       } else if($type === 'Retainer(Режим «Word файлы»)') {
           $text = $this->highLightRetainer($data, $index);
       } else if($type === 'Retainer(Режим «Диплом»)') {
           $text = $this->highLightRetainer($data, $index);
       }
      return $text;
    }


    public function highLightRetainer($data, $index)
    {
        if(count($data['urls']) === 0) {
            return $data['clear_text'];
        }
        if($index === -1) {

            return json_decode($data['clear_text']);
        } else {
            return $data['urls'][$index]['text'];
        }
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
        $wordsIndexesArr = explode(' ', $data['urls'][$index]['words']);
        if(isset($data['words_pos'])) {
            $text = mb_convert_encoding($data['clear_text'], "UTF-8", mb_detect_encoding($data['clear_text']));
            dd($text);
            $textArr = $this->textToArrayTextRu($text, $data['words_pos']);
        } else {
            $textArr  = $this->textToArray($data['clear_text']);

        }

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

    private function highLightAdvego($data, $index)
    {
        if($index === -1) {
            $highlight = $data['position'];
        } else {
            $highlight = $data['urls'][$index]['position'];
        }
        $textArr = $data['text_fragments'];

        foreach ($highlight as $item) {
            $item_index = 2 * $item + 1;
            if(isset($textArr[$item_index])) {
                $textArr[$item_index] = '<span class="highlight--red">' . $textArr[$item_index] . '</span>';
            }
        }

        $text = implode(" ", $textArr);
        return $text;
    }
    private function textToArray($string)
    {
        $array_words = [];
        /*
        $separator = " \t\n";

        $tok = strtok($string, $separator);
        while($tok) {
            $array_words[] = $tok;
            $tok = strtok(" \t\n");
        }*/

        $array_words = preg_split('/\s+/', $string);

        return $array_words;
    }
    protected function textToArrayTextRu($text, $word_pos)
    {
        $textArr = [];
        $textLength = mb_strlen($text);

        foreach ($word_pos as $item) {
            $start = (int) $item[0];
            $end = (int) $item[1] + 2; // Используем конец слова напрямую

            // Предварительная проверка границ текста
            if ($start >= $textLength || $end > $textLength || $start >= $end) {
                continue;
            }

            $length = min($end - $start, $textLength - $start); // Уменьшение длины, если за границами текста

            $string = mb_substr($text, $start, $length);

            $textArr[] = $string;
        }

        return $textArr;
    }

}
