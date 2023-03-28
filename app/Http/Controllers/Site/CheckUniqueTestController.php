<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ApiAccount;
use App\Models\CheckSystem;
use App\Services\CheckUnique\ContentWatchApi\ContentWatchApi;
use Illuminate\Http\Request;

class CheckUniqueTestController extends Controller
{
    public function checkTest()
    {
        $system = CheckSystem::findOrfail(2);
        $account = ApiAccount::where('api_id', $system->checkApi->id)->first();

        $api = new ContentWatchApi($account->key);
        $text= 'В 2023 году SQL (Structured Query Language) остается одним из самых популярных языков программирования, используемых в области баз данных и аналитики данных. Изучение SQL может быть полезным как для тех, кто только начинает свой путь в IT, так и для опытных профессионалов, которые хотят расширить свои знания и навыки. В этой статье мы рассмотрим несколько советов и ресурсов, которые помогут вам изучать SQL в 2023 году, и оставаться в курсе последних тенденций и изменений в этой области.

Согласно данным сайта Indeed.com, в 2023 году требования к кандидатам в вакансиях, связанных с базами данных и анализом данных, включают знание SQL в качестве обязательного навыка. Некоторые из таких популярных вакансий включают в себя SQL Developer, Data Analyst, Database Administrator, Business Intelligence Analyst и другие. Согласно данным сайта Glassdoor, зарплата специалистов, владеющих навыками работы с SQL, может составлять от $50 000 до $100 000 в год в зависимости от региона и уровня опыта. В связи с этим, изучение SQL может быть полезным для тех, кто хочет улучшить свои шансы на рынке труда и получать высокую заработную плату в IT-сфере.';
        dd($api->add($text));
    }
}
