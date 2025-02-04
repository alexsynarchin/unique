<?php

namespace App\Services\CheckUnique\TextRuApiService;

use App\Services\TextRuApi\TextRuApi;

class TextRuApiService
{
    private $userkey;



    public function __construct($userkey, $client_id)
    {
        $this->userkey = $userkey;
    }

    private function getUid($text)
    {

        $TextRuApi= new TextRuApi($this->userkey);
        $result = $TextRuApi->add($text);

        $uid = $result["text_uid"];
        $reportData = [
            'uid' => $uid,
            'checked' => false,
            'data' => [],
        ];

        if($result['error']['code'] !== 181 && $result['error']['code'] !== 183 && $result['error']['code'] !== 429) {
           $reportData['error_code'] = $result['error']['code'] ?? 0;
            $reportData['error'] = $result['error']['desc'] ?? null;
        }
        return  $reportData;
    }

    private function getResult($uid)
    {
        //sleep(15);
        //Получаете результат проверки
        $jsonvisible = 'detail_view'; //Необязательный параметр. Укажите "detail" чтобы получить расширенные данные по тексту
        $TextRuApi= new TextRuApi($this->userkey);
        $result = $TextRuApi->get($uid, $jsonvisible);

        if($result['error']['code'] !== 181 && $result['error']['code'] !== 183 && $result['error']['code'] !== 429) {

            $data = json_decode($result['result_json'], true);

            if(isset($result['text_view'])) $data['clear_text'] = $result['text_view'];
            if(isset($result ['words_pos'])) $data['words_pos'] = $result['words_pos'];

            //print_r(json_decode($result['result_json']));
            return [
                'checked' => true,
                'data' => $data,

            ];
        }  else {

            return  ['checked' => false,'data' => []];
        }

    }
    public function add($report, $text)
    {
        if(!$report->uid) {
            $result = $this->getUid($text);
        } else {
            $result = $this->getResult($report->uid);
        }

        return $result;
    }

    private function sendCurl($post_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.text.ru/post');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, \json_encode($post_data));

        $rawResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Ошибка curl: ' . curl_error($ch));
        }

        curl_close($ch);

        $response = \json_decode($rawResponse, true);
    }
}
