<?php

namespace App\Services\CheckUnique\Advego;

class AdvegoApi
{
    private $userkey;



    public function __construct($userkey, $client_id)
    {
        $this->userkey = $userkey;

    }


    private function getUid($text)
    {
        $post_data = [
            'id' => '2',
            'jsonrpc' => '2.0',
            'method' => 'unique_text_add',
            'params' => [
                'token' => $this->userkey,
                'text' => $text,
            ],
        ];
        $result = $this->sendCurl('https://api.advego.com/json/antiplagiat/add/', $post_data);

        return [
            'uid' => $result['result']['key'] ?? null,
            'checked' => false,
            'data' => [],
            'error_code' => $result['result']['error'] ?? 0,
            'error' =>$result['result']['error_msg'] ?? null
        ];
    }

    public function getResult($uid)
    {
        $post_data = [
            'id' => '2',
            'jsonrpc' => '2.0',
            'method' => 'unique_check',
            'params' => [
                'token' => $this->userkey,
                'key' => ''. $uid,
                'get_text' =>1,
                'report_json' => 1,
            ],
        ];
        $result = $this->sendCurl('https://api.advego.com/json/antiplagiat/get/', $post_data);

        if(isset($result['result']['status']) && $result['result']['status'] === 'done') {
            if(isset($result['result']['report']['layers'])) {
                $urls = $result['result']['report']['layers'];
                if(is_array($urls) && count($urls) > 0) {
                    foreach ($urls as $key => $url) {
                        $urls[$key] = $this -> replaceArrKey($url, 'equality', 'plagiat');

                    }
                    foreach ($urls as $key => $url) {
                        $urls[$key] = $this -> replaceArrKey($url, 'shingles', 'position');
                    }
                    foreach ($urls as $key => $url) {
                        $urls[$key] = $this -> replaceArrKey($url, 'uri', 'url');
                    }
                }
            } else {
                $urls = [];
            }
            $data = [
                'clear_text' => $result['result']['text'] ?? '',
                'unique' => 100 - $result['result']['report']['equality'] ?? 0,
                'position' => $result['result']['report']['equal_shingle_words'] ?? [],
                'text_fragments' => $result['result']['report']['text_fragments'] ?? [],
                'urls' => $urls,
            ];
            $result_data = [
                'checked'=>true,
                'data'=> $data
                ];
        } else {
            $result_data = [
                'checked' =>false,
                'data' => []
            ];
        }
        return $result_data;
    }
    private function sendCurl($url, $post_data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = json_decode(trim(curl_exec($curl)), TRUE);
        curl_close($curl);

        return $result;
    }

    public function add($report, $text)
    {
        //a11fbda7-8818-4fdf-8330-f52832ac2c20
        //$result = $this->getUid($text);
        $checked = !isset($result['result']['error']);
        //24304040
      //$result = $this->getResult(24312192);
        //dd($result);
       if(!$report->uid) {
            $result = $this->getUid($text);
        } else {
            $result = $this->getResult($report->uid);
        }
        return $result;
    }

    private function replaceArrKey($arr, $oldkey, $newkey)
    {
        if(array_key_exists( $oldkey, $arr)) {
            $keys = array_keys($arr);
            $keys[array_search($oldkey, $keys)] = $newkey;
            return array_combine($keys, $arr);
        }

        return $arr;
    }
}
