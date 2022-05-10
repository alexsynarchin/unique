<?php

namespace App\Services\CheckUnique;

class CheckUnique
{
    public function check($data)
    {
        $userkey = '66607d4fbd0b0c47af9a02ed3045fff2';

        $TextRuApi= new \TextRuApi\TextRuApi($userkey);
        $result = $TextRuApi->add($data['text']);
        $uid = $result["text_uid"];
        dd($result);
    }
}
