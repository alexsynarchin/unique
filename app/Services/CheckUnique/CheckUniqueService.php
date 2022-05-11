<?php

namespace App\Services\CheckUnique;

class CheckUniqueService
{
    public function getUid($text)
    {
        $userkey = '7a7b404004f32189cd5dd70c4eb23d70';

        $TextRuApi= new \TextRuApi\TextRuApi($userkey);
        $result = $TextRuApi->add($text);
        dd($result);
        $uid = $result["text_uid"];
        return $uid;
    }

    public function getResult($uid)
    {
        $userkey = '7a7b404004f32189cd5dd70c4eb23d70';
        sleep(95);
        //Получаете результат проверки
        $jsonvisible = 'detail'; //Необязательный параметр. Укажите "detail" чтобы получить расширенные данные по тексту
        $TextRuApi= new \TextRuApi\TextRuApi($userkey);
        $result = $TextRuApi->get($uid, $jsonvisible);
        return $result;
    }
}
