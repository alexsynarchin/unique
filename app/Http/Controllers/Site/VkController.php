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
        $redirect_uri = 'https://%D0%BF%D1%80%D0%BE%D0%B2%D0%B5%D1%80%D0%B8%D1%82%D1%8C-%D1%83%D0%BD%D0%B8%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D0%BE%D1%81%D1%82%D1%8C.%D1%80%D1%84/vk';
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
