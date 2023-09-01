<?php

namespace App\Jobs;

use App\Helpers\AppHelper;
use App\Mail\AdminReportMail;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessEmailTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $order;

    public function __construct($order)
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
        //AppHelper::setMailConfig();
        $mail = Setting::where('group', 'smtp')->pluck('value', 'name');
        $mailConfig = array(
            'transport' => 'smtp',
            'host'       => $mail['host'],
            'port'       => $mail['port'],
            'encryption' => $mail['encryption'],
            'username'   => $mail['email'],
            'password'   => $mail['password']

        );
        config(['mail.mailers.smtp' => $mailConfig]);
        Mail::mailer('smtp')->to('gwynbleid11@yandex.ru')->send(new AdminReportMail($this->order, 'report@unikaltext.ru'));
    }
}
