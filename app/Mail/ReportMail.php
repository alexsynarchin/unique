<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

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
        $name_from = Setting::where('group', 'smtp')->where('name','email')->firstOrFail();
        $mail = $this->from($name_from->value)
            -> subject('Отчет о проверке уникальности (' . $this->report->checkSystem->title . ')');
        $setting = Setting::where('name', 'phone_header')->firstOrFail();
        return $mail-> view('mails.contact' , ['data' => $this-> report, 'phone' => $setting->value])
            ->attach(public_path() . $this->link, [
                'mime' => 'application/pdf',
            ]);
    }
}
