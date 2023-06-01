<?php

namespace App\Services\Report;

use App\Helpers\AppHelper;
use App\Mail\ReportMail;
use App\Models\Report;
use App\Models\Setting;
use App\Models\UniqueOrder;
use App\Services\GeneratePdfService;
use Illuminate\Support\Facades\Mail;

class ReportSendEmail
{
    public function send($id)
    {
        $send_status = false;
        if(Setting::where('group', 'common') -> where('name', 'free_email_send') -> exists()) {
            $send_setting = Setting::where('group', 'common') -> where('name', 'free_email_send')->first();
            $send_setting = $send_setting -> value;
            if( ((int) $send_setting) === 1) {
                $send_status = true;
            }
        }


        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);
        if($report->unique_order_id) {
            $unique_order = UniqueOrder::firstOrFail($report->unique_order_id);
            if($unique_order->status === 'paid') {
                $send_status = true;
            }
        }
        if($send_status ) {
            $generatePdfService = new GeneratePdfService();
            $link = $generatePdfService -> generate($id);
            AppHelper::setMailConfig();
            try {
                Mail::to($report->checkUnique->email)->send(new ReportMail($link, $report));
            } catch (\Exception $e) {

            }

        }

        return $send_status;
    }
}
