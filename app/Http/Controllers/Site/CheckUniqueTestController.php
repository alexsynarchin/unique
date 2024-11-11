<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ApiAccount;
use App\Models\CheckApi;
use App\Models\CheckSystem;
use App\Services\CheckUnique\ContentWatchApi\ContentWatchApi;
use App\Services\CheckUnique\Textovod\TextovodApiService;
use App\Services\CheckUnique\Advego\AdvegoApi;
use App\Services\CheckUnique\TextRuApiService\TextRuApiService;
use Illuminate\Http\Request;
use App\Services\CloudPaymentsService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class CheckUniqueTestController extends Controller
{
    protected CloudPaymentsService $cloudPaymentsService;
    public function __construct(CloudPaymentsService $cloudPaymentsService)
    {
        $this->cloudPaymentsService = $cloudPaymentsService;
    }
    public function checkTest()
    {

        $client = new Client([
        'auth' => ['pk_2180f0785984f6b018ba6da1fe0bd', 'b4c496a661750edaca8942434d6189e0']
]);;
        $data = [
            'Inn' => "021400653471",
            "Type" => "Income",
            "InvoiceId" => "22123",
            "CustomerReceipt" => [
                "Amounts" => [
                    "Electronic" => 1
                ],
                "Email" => "gwynbleid11@yandex.ru",
                "items" => [
                    [
                        "Label" => "Проверка уникальности текста",
                        "Price" =>  "1",
                        "Quantity" => 1,
                        "Vat" => 0,
                        "Amount" => 1
                    ]

                ]
            ]
        ];
        $data = json_encode($data);
        //22123
        $res = $client->request(
            'POST',
            'https://api.cloudpayments.ru/kkt/receipt',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $data
            ]

        );
        dd($res->getBody()->getContents());
       // $this->cloudPaymentsService->createPayment($order);
    }
}
