<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \VK\Client\VKApiClient;
use \VK\OAuth\VKOAuth;
use \VK\OAuth\VKOAuthDisplay;
use \VK\OAuth\Scopes\VKOAuthUserScope;
use \VK\OAuth\VKOAuthResponseType;


class VkontakteController extends Controller
{


    public function wallPost()
    {
        $vk = new \VK\Client\VKApiClient();
        $oauth = new \VK\OAuth\VKOAuth();
        //51554125
        //51581291
        //51581157
        //https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/vk
        $client_id =51554125;
        //$redirect_uri = 'https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/vk';
        $redirect_uri = 'http://unique.loc/vk';
        $display = VKOAuthDisplay::PAGE;
        $scope = array(VKOAuthUserScope::WALL,  VKOAuthUserScope::GROUPS);

        //45uuDrTz0Pcia2fhSwBy
        //GZlXA1GHvYa0KoELFuzN
        //sS5baBw26QoqQ2J8D18n
        $state = '45uuDrTz0Pcia2fhSwBy';
        $browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::CODE, $client_id, $redirect_uri, $display, $scope, $state);
        return $browser_url;
    }
}
