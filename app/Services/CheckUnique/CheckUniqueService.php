<?php

namespace App\Services\CheckUnique;

use App\Jobs\GenerateReportPdf;
use App\Models\ApiAccount;
use App\Models\Report;
use App\Services\CheckUnique\Advego\AdvegoApi;
use App\Services\CheckUnique\ContentWatchApi\ContentWatchApi;
use App\Services\CheckUnique\Retainer\RetainerApiService;
use App\Services\CheckUnique\Textovod\TextovodApiService;
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
        'textovod.ru' => TextovodApiService::class,
        'advego.com' => AdvegoApi::class,
        'Retainer(Парсер Go (Google))' => RetainerApiService::class,
        'Retainer(Режим «Word файлы»)' => RetainerApiService::class,
        'Retainer(Режим «Диплом»)' => RetainerApiService::class,
        'Retainer(Парсер Go (Yahoo))' => RetainerApiService::class
    ];

    public function __construct($id)
    {
        $this->id = $id;
    }



    public function getResult()
    {
        $report = Report::with('checkSystem') ->findOrFail($this->id);
        $uniqueOrder = $report->uniqueOrder();
        if($uniqueOrder) {
            if($uniqueOrder->sum === 0) {
                $report->need_payment = false;
                $report->save();
            }
        }
        if($report->need_payment || $report->result || $report->checkSystem->manual) {
            return $report;
        }
        $check_unique = $report->checkUnique()->first();
        $symbols = $report->checkSystem -> symbols_count;
        $text = mb_substr($check_unique->plainText, 0, $symbols);

        //$account = ApiAccount::where('api_id', $report->checkSystem->checkApi->id)->exists()
        if($report->checkSystem->checkApi->id === 1 ||
            $report->checkSystem->checkApi->id ===2 ||
            $report->checkSystem->checkApi->id ===3 ||
            $report->checkSystem->checkApi->id ===4 ||
            $report->checkSystem->checkApi->id ===7 ||
            $report->checkSystem->checkApi->id ===8 ||
            $report->checkSystem->checkApi->id ===9 ||
            $report->checkSystem->checkApi->id ===10
        ) {

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



    private function selectApiServiceClass($api)
    {
        return $this->apis[$api];
    }
}
