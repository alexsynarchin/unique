<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RewriteOrder extends Mailable
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
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(env('MAIL_FROM_ADDRESS'))
            -> subject('Новая заявка на рерайт');
        if($this->contact->filename) {
            return $mail->view('mails.rewrite-order', ['contact' => $this->contact])
                ->attach('storage/rewrites/' . $this->contact->id . '/' . $this->contact->filename);
        } else {
            return $mail->view('mails.rewrite-order', ['contact' => $this->contact]);
        }

    }
}
