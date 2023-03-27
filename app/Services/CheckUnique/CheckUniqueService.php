<?php

namespace App\Services\CheckUnique;

class CheckUniqueService
{
    public function getUid($text)
    {
        $userkey = '2c58d49fbb37631e5867ada0dd394f66';

        $TextRuApi= new \TextRuApi\TextRuApi($userkey);
        $result = $TextRuApi->add($text);

        $uid = $result["text_uid"];
        return $uid;
    }

    public function getResult($uid)
    {
        $userkey = '2c58d49fbb37631e5867ada0dd394f66';
        sleep(15);
        //Получаете результат проверки
        $jsonvisible = 'detail'; //Необязательный параметр. Укажите "detail" чтобы получить расширенные данные по тексту
        $TextRuApi= new \TextRuApi\TextRuApi($userkey);
        $result = $TextRuApi->get($uid, $jsonvisible);

        return $result;
    }
}
