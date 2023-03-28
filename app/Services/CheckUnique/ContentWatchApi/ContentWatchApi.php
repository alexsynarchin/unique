<?php

namespace App\Services\CheckUnique\ContentWatchApi;

class ContentWatchApi
{

    private $userkey;

    public function __construct($userkey)
    {
        $this->userkey = $userkey;
    }

    public function add($report, $text)
    {


        $post_data = array(
            'key' => $this->userkey, // ваш ключ доступа (параметр key) со страницы https://content-watch.ru/api/request/
            'text' => $text,
            'test' => 0 // при значении 1 вы получите валидный фиктивный ответ (проверки не будет, деньги не будут списаны)
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_URL, 'https://content-watch.ru/public/api/');
        $return = json_decode(trim(curl_exec($curl)), TRUE);
        curl_close($curl);

// если в ответе нет переменной error, значит запрос не удался
        if (!isset($return['error'])) {
            return ['error' => 'Ошибка запроса', 'error_code' => 999];

// если переменная error не пустая, значит при проверке возникла ошибка
        } else if (!empty($return['error'])) {
           return ['error' => $return['error'], 'error_code' => (int) $return['error_code']];

// парсим ответ
        } else {
            // инициализируем дефолтные значения
            $defaults = array(
                'text' => '',
                'percent' => '100.0',
                'highlight' => array(),
                'matches' => array()
            );
             $data = array_merge($defaults, $return);
             $matches = [];
             foreach ($data['matches'] as $item) {
                 $matches[]= [
                     'url' => $item['url'],
                     'plagiat' => $item['percent'],
                     'highlight' => $item['highlight']
                 ];
             }
            $data = [
                'clear_text' => $data['text'],
                'unique' =>  $data['percent'],
                'highlight' => $data['highlight'],
                'urls' => $matches
            ];

            return  [
                'checked' => true,
                'data' =>$data,
            ];
        }
    }
}
