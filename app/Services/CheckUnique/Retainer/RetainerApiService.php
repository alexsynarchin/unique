<?php

namespace App\Services\CheckUnique\Retainer;

class RetainerApiService
{
    private $userkey;
    private $client_id;

    public function __construct($userkey, $client_id)
    {
        $this->userkey = $userkey;
        $this->client_id = $client_id;
    }

    public function add($report, $text)
    {

        if(!$report->uid) {
            $result = $this->getUid($text);
        } else {
            $result = $this->getResult($report->uid, $report->id);
        }
       return $result;
    }

    private function getUid($text)
    {

        $post_data = [
            'userkey' => $this->userkey,
            'text' => $text,
            'type' => $this->client_id
        ];

        $result = $this->sendCurl('https://api.ап-вуз.рф/v1/post/index', $post_data);

        return [
            'uid' => $result['text_uid'] ?? null,
            'checked' => false,
            'data' => [],
            'error_code' => $result['error_code'] ?? 0,
            'error' =>$result['error_desc'] ?? null
        ];
    }

    public function getResult($uid, $id)
    {
        $post_data = [
            'userkey' => $this->userkey,
            'uid' => $uid,
            'type' => $this->client_id
        ];
        $reportData = [];
        $result = $this->sendCurl('https://api.ап-вуз.рф/v1/post/check', $post_data);
        $checked = false;
        if(isset($result['error_code']) && $result['error_code'] != 181) {
            $reportData['error_code'] = $result['error_code'] ?? 0;
            $reportData['error'] = $result['error_desc'] ?? null;
            $data = [];
        } else {
            $data = [
                'clear_text' => $result['clear_text'] ?? '',
                'unique' => $result['text_unique'] ?? '',
                'urls' => $result['result_json']['urls'] ?? [],
            ];


            $data['clear_text'] = str_replace('light-word', 'highlight--red', $data['clear_text']);
            foreach ($data['urls'] as $key => $url) {
                $data['urls'][$key]['text'] = str_replace('light-word', 'highlight--red', $url['text']);
            }
            if(!isset($result['error_code'])) {
                $checked = true;
            }
        }

        $reportData['checked'] = $checked;
        $reportData['data'] = $data;
        return $reportData;
    }

    private function sendCurl($url, $post_data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = json_decode(trim(curl_exec($curl)), TRUE);
        curl_close($curl);

        return $result;
    }
}
