<?php

namespace App\Services\CheckUnique\Textovod;

class TextovodApiService
{
    private $userkey;

    private $client_id;

    public function __construct($userkey, $client_id)
    {
        $this->userkey = $userkey;
        $this->client_id = $client_id;
    }

    private function getUid($text)
    {
        $post_data = array(
            'user_id' =>$this->client_id,
            'api_key' => $this->userkey,
            'text' => $text
        );

        return $this->sendCurl('https://textovod.com/api/unique/user/add', $post_data);
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

    private function getResult($uid)
    {
        $post_data = array(
            'user_id' =>$this->client_id,
            'api_key' => $this->userkey,
            'text_id' => $uid
        );

        return $this->sendCurl('https://textovod.com/api/unique/user/status', $post_data);
    }

    public function add($report, $text)
    {
        if(!$report->uid) {
            $result = $this->getUid($text);
        } else {
            $result = $this->getResult($report->uid);
        }
        //$result = $this->getUid($text);
        $checked = isset($result['status']) && $result['status'] === 2;
        $data = [];
        if($checked) {
            if(isset($result['urls'])) {
                $urls = json_decode($result['urls'], true);
            } else {
                $urls = [];
            }
            if(count($urls) > 0)
            {
                foreach ($urls as $key => $url) {

                    $urls[$key] = $this -> replaceArrKey($url, 'similarity', 'plagiat');
                }
            }
            $data = [
                'clear_text' => isset($result['text']) ?:'',
                'unique' => isset($result['originality']) ?: '',
                'position' => isset($result['position'])? :'',
                'urls' => $urls,
                ];

        }
        $result_data = [
            'uid' => isset($result['text_id'])?:'',
            'checked' => $checked,
            'data' => $data,
            'error_code' => isset($result['info']) ? 999 : 0,
            'error' =>isset($result['info']) ? :''
        ];

        return $result_data;
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
