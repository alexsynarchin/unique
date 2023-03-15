<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VkController extends Controller
{
    public function index(Request $request)
    {

        $oauth = new \VK\OAuth\VKOAuth();
        $client_id = 51581240;
        $client_secret = 'sS5baBw26QoqQ2J8D18n';
        $redirect_uri = 'http://unique.loc/vk';
        $code = $request->get('code');

        $response = $oauth->getAccessToken($client_id, $client_secret, $redirect_uri, $code);
        $access_token = $response['access_token'];

        $vk = new \VK\Client\VKApiClient();
        dd($response);
     /*   $vk_wall_response = $vk->wall()->post($access_token, [
            'owner_id'=> $response['user_id'],
            'message'=> 'test'
        ]);*/


    }
}
