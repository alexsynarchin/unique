<?php

namespace App\Jobs;

use App\Mail\ReportMail;
use App\Models\Report;
use App\Services\GeneratePdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateReportPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $report;
    public function __construct(Report $report)
    {
        $this->report = $report;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $generatePdfService = new GeneratePdfService();
        $link = $generatePdfService -> generate($this->report->id);
        Mail::to($this->report->checkUnique->email)->send(new ReportMail($link, $this->report));
    }
}
