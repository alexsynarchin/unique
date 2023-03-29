<?php

namespace App\Services\CheckUnique;

use App\Jobs\GenerateReportPdf;
use App\Models\ApiAccount;
use App\Models\Report;
use App\Services\CheckUnique\ContentWatchApi\ContentWatchApi;
use App\Services\CheckUnique\TextRuApiService\TextRuApiService;
use App\Services\GeneratePdfService;
use App\Services\Report\ReportService;
use App\Services\ReportHighLightTextService;

class CheckUniqueService
{
    private $id;
    private $apis = [
        'text.ru' => TextRuApiService::class,
        'content-watch.ru' => ContentWatchApi::class,
    ];

    public function __construct($id)
    {
        $this->id = $id;
    }



    public function getResult()
    {
        $report = Report::findOrFail($this->id);
        $check_unique = $report->checkUnique()->first();
        $symbols = $report->checkSystem -> symbols_count;
        $text = mb_substr($check_unique->plainText, 0, $symbols);

        //$account = ApiAccount::where('api_id', $report->checkSystem->checkApi->id)->exists()
        if($report->checkSystem->checkApi->id === 1 || $report->checkSystem->checkApi->id ===2  ) {
            sleep(15);
            $account = ApiAccount::where('api_id', $report->checkSystem->checkApi->id)->first();
            $apiServiceClass = $this->selectApiServiceClass($report->checkSystem->checkApi->title);
            $apiService = new $apiServiceClass($account->key, $account->client_id);
            $result = $apiService->add($report, $text);
            $report->update($result);
            if($result['checked']) {
                $report->result = true;
                $highLightService = new ReportHighLightTextService();
                $report->highlight_text = $highLightService->highLightText($report['data'], $report->checkSystem->checkApi -> title);
                $report->save();
                if(!$report->filename) {
                    $generatePdfService = new GeneratePdfService();
                    $link = $generatePdfService -> generate($report->id);
                    GenerateReportPdf::dispatch($report);
                }
        }

        } else {
            $report ->error_code = 255;
            $report -> error = 'Ошибка доступа к api';
        }
        $report->save();
        return $report;
    }

    public function getResultTest($uid)
    {
        $userkey = '2c58d49fbb37631e5867ada0dd394f66';
        sleep(15);
        //Получаете результат проверки
        $jsonvisible = 'detail'; //Необязательный параметр. Укажите "detail" чтобы получить расширенные данные по тексту
        $TextRuApi= new \TextRuApi\TextRuApi($userkey);
        $result = $TextRuApi->get($uid, $jsonvisible);

        return $result;
    }

    private function selectApiServiceClass($api)
    {
        return $this->apis[$api];
    }
}
