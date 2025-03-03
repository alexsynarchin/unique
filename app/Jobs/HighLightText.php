<?php

namespace App\Jobs;

use App\Models\CheckApi;
use App\Models\Report;
use App\Services\ReportHighLightTextService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HighLightText implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $report;

    private ReportHighLightTextService $highLightTextService;
    public function __construct(Report $report)
    {
        $this -> report = $report;
        $this -> highLightTextService = new ReportHighLightTextService();

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $check_api = CheckApi::findOrFail($this->report->api_id);

        $this->report->highlight_text = $this->highLightTextService
            ->highLightText($this -> report['data'], $check_api-> title);
        $this->report->result = true;
        if(!$this->report->filename) {
            GenerateReportPdf::dispatch($this->report);
        }

        $this -> report->save();
    }
}
