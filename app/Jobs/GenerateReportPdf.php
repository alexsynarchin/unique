<?php

namespace App\Jobs;

use App\Helpers\AppHelper;
use App\Mail\ReportMail;
use App\Models\Report;
use App\Models\Setting;
use App\Models\UniqueOrder;
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
        $send_status = false;
        if(Setting::where('group', 'common') -> where('name', 'free_email_send') -> exists()) {
            $send_setting = Setting::where('group', 'common') -> where('name', 'free_email_send')->first();
            $send_setting = $send_setting -> value;
            if( ((int) $send_setting) === 1) {
                $send_status = true;
            }
        }



        if($this->report->unique_order_id) {
            $unique_order = UniqueOrder::firstOrFail($this->report->unique_order_id);
            if($unique_order->status === 'paid') {
                $send_status = true;
            }
        }
        if($send_status ) {
            $generatePdfService = new GeneratePdfService();
            $link = $generatePdfService -> generate($this->report->id);
            //$link = "/storage/reports/". $this->report->check_unique_id."/report-" .$this->report->id.".pdf";
            AppHelper::setMailConfig();
            Mail::to($this->report->checkUnique->email)->send(new ReportMail($link, $this->report));

        }
    }
}
