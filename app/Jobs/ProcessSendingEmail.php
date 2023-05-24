<?php

namespace App\Jobs;

use App\Mail\AdminReportMail;
use App\Mail\ReportMail;
use App\Models\Report;
use App\Models\Setting;
use App\Services\GeneratePdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessSendingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Report $report)
    {

        $generatePdfService = new GeneratePdfService();
        $link = $generatePdfService -> generate($report->id);
        Mail::to($report->checkUnique->email)->send(new ReportMail($link, $report));
        $exists= Setting::where('group', 'common')->where('name','email_admin')->exists();

        if($exists) {
            $setting = Setting::where('group', 'common')->where('name','email_admin') ->firstOrFail();
            $admin_email = $setting -> value;
            $admin_email = explode(',', $admin_email);
        } else {
            $admin_email = ['alexsynarchin@gmail.com'];
        }
        $form = [
            'link' => $link
        ];
        foreach ($admin_email as $recipient) {
            Mail::to($recipient)->send(new AdminReportMail($form));
        }
    }
}
