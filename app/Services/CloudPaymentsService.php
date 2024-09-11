<?php

namespace App\Services;

use GuzzleHttp;
class CloudPaymentsService
{
    public function createPayment($order)
    {
        $client = new GuzzleHttp\Client;

        $res = $client->request('GET', 'https://api.cloudpayments.ru/test', [
            'auth' => [env("CLOUD_PAYMENTS_USER"), env("CLOUD_PAYMENTS_PASS")],
        ]);
        dd($res->getBody()->getContents());
    }
}
