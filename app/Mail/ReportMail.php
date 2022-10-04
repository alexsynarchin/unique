<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;
    public $link;
    public $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $report)
    {
        $this -> link = $link;
        $this -> report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('gwynbleid11@yandex.ru')
            -> subject('Отчет о проверке уникальности');
        return $mail-> view('mails.contact' , ['data' => $this-> report])
            ->attach(public_path() . $this->link, [
                'mime' => 'application/pdf',
            ]);
    }
}
