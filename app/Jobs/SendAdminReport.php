<?php

namespace App\Jobs;

use App\Helpers\AppHelper;
use App\Mail\AdminReportMail;
use App\Models\Setting;
use App\Models\UniqueOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAdminReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $order;

    public function __construct(UniqueOrder $order)
    {
        $this -> order = $order;
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

        foreach ($email as $recipient) {
            AppHelper::setMailConfig();
            try {
                Mail::to(trim($recipient))->send(new AdminReportMail($this->order));
            }
            catch(\Exception $e) { // alternatively use \Exception
                // dump error
            }

        }
    }
}
