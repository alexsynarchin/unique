<?php

namespace App\Jobs;

use App\Helpers\AppHelper;
use App\Mail\AdminReportMail;
use App\Models\Setting;
use App\Models\UniqueOrder;
use App\Services\mailConfigService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendAdminReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $order;
    protected $name;
    public function __construct(UniqueOrder $order, $name)
    {
        $this -> order = $order;

        $this -> name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $exists= Setting::where('group', 'common')->where('name','email_admin')->exists();

        if($exists) {
            $setting = Setting::where('group', 'common')->where('name','email_admin') ->firstOrFail();
            $email = $setting -> value;
            $email = explode(',', $email);
        } else {
            $email = ['alexsynarchin@gmail.com'];
        }
        $mailConfigService = new mailConfigService();
        $mailConfig = $mailConfigService -> generateConfig($this -> name);
        foreach ($email as $recipient) {

            config(['mail.mailers.smtp' => $mailConfig]);
            Mail::to(trim($recipient))->send(new AdminReportMail($this->order));

        }
    }

    public function failed(Throwable $exception)
    {
        SendAdminReport::dispatch($this -> order, 'smtp_reserve')->delay(now());
    }
}
