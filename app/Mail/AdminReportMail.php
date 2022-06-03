<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $contact;

    public function __construct($contact)
    {
        $this -> contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('gwynbleid11@yandex.ru')
        -> subject('Новая запрос на проверку уникальности');
        return $mail->view('mails.report.admin.blade') ->attach(public_path() . $this->contact['link'], [
            'mime' => 'application/pdf',
        ]);
    }
}
