<?php

namespace App\Services\CheckUnique\TextRuApiService;

class TextRuApiService
{
    private $userkey;



    public function __construct($userkey, $client_id)
    {
        $this->userkey = $userkey;
    }

    private function getUid($text)
    {

        $TextRuApi= new \TextRuApi\TextRuApi($this->userkey);
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
        $jsonvisible = 'detail'; //Необязательный параметр. Укажите "detail" чтобы получить расширенные данные по тексту
        $TextRuApi= new \TextRuApi\TextRuApi($this->userkey);
        $result = $TextRuApi->get($uid, $jsonvisible);

        if($result['error']['code'] !== 181 && $result['error']['code'] !== 183 && $result['error']['code'] !== 429) {

            return [
                'checked' => true,
                'data' => json_decode($result['result_json']),

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
}
