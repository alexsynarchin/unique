<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class VkontakteController extends Controller
{
    public function wallPost()
    {
        $vk = new \VK\Client\VKApiClient();
        $oauth = new \VK\OAuth\VKOAuth();
        $client_id = 1234567;

    }
}
