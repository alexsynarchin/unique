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

class CheckUniqueTestController extends Controller
{
    public function checkTest()
    {
        $system = CheckApi::findOrfail(4);
        $account = ApiAccount::where('api_id', $system->id)->first();

        $api = new AdvegoApi($account->key, null);
        $text= 'После выбора площадки для торговли селлеру предстоит юридически правильно оформить правоотношения с маркетплейсом. Для этого нужно заключить договор — принять оферту или «предложение» о сотрудничестве с вытекающими последствиями.

Для принятия оферты необязательно ставить на бумаге свою подпись. Принятием оферты считаются даже действия в личном кабинете. Подписанный бумажный вариант договора маркетплейсы требуют редко. Такое условие встречается только на Aliexpress, где контракт сначала подписывают электронной подписью, а потом обмениваются бумажными вариантами.';
        dd($api->add($text));
    }
}
