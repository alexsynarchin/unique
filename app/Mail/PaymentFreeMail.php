<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class PaymentFreeMail extends Mailable
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
        $mail = $this->from(Config::get('mail.mailers.smtp.username'))
            -> subject('Вы произвели оплату с произвольной формы на сайте Проверить-уникальность.рф');
        return $mail->view('mails.report-free');
    }
}
