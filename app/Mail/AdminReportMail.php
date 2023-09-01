<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class AdminReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;

    public function __construct($order)
    {
        $this -> order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //Config::get('settings.smtp.email')
        $name_from = Setting::where('group', 'smtp')->where('name','email')->firstOrFail();
        $mail = $this->from($name_from->value)
        -> subject('Новый запрос на проверку уникальности');
        return $mail->view('mails.report-admin');
    }
}
