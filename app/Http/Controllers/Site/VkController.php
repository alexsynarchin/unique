<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VkController extends Controller
{
    public function index(Request $request)
    {

        $oauth = new \VK\OAuth\VKOAuth();
        $client_id = 51553840;
        $client_secret = '45uuDrTz0Pcia2fhSwBy';
        $redirect_uri = 'http://unique.loc/vk';
        $code = $request->get('code');

        $response = $oauth->getAccessToken($client_id, $client_secret, $redirect_uri, $code);
        $access_token = $response['access_token'];

        $vk = new \VK\Client\VKApiClient();

        $vk_wall_response = $vk->wall()->post($access_token, [
            'owner_id'=> $response['user_id'],
            'message'=> 'test'
        ]);
        dd($response);

    }
}