<?php

namespace App\Services\CheckUnique\Advego;

class AdvegoApi
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

    public function add($text)
    {
        //a11fbda7-8818-4fdf-8330-f52832ac2c20

        $post_data = [
            'jsonrpc' => '2.0',
            'method' => 'unique_text_add',
            'params' => [

            ],
        ];
    }
}
