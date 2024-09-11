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

class CheckUniqueTestController extends Controller
{
    protected CloudPaymentsService $cloudPaymentsService;
    public function __construct(CloudPaymentsService $cloudPaymentsService)
    {
        $this->cloudPaymentsService = $cloudPaymentsService;
    }
    public function checkTest()
    {
        $order = [
            'test' => 'test',
        ];
        $this->cloudPaymentsService->createPayment($order);
    }
}
