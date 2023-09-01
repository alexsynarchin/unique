<?php

namespace App\Mail;

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
    public $from;

    public function __construct($order, $from)
    {
        $this -> order = $order;
        $this -> from = $from;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //Config::get('settings.smtp.email')
        $mail = $this->from($this->from)
        -> subject('Новый запрос на проверку уникальности');
        return $mail->view('mails.report-admin');
    }
}
