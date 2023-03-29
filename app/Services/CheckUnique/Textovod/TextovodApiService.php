<?php

namespace App\Services\CheckUnique\Textovod;

class TextovodApiService
{
    private $userkey;

    public function __construct($userkey)
    {
        $this->userkey = $userkey;
    }
}
