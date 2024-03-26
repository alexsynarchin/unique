<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Setting;
use App\Models\UniqueOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class NeedPayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $order;
    private $url;
    public function __construct(UniqueOrder  $order, $url)
    {
        $this->order = $order;
        $this->url = $url;
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
            -> subject('Вам выставлен счет за проверку уникальности');
        return $mail->view('mails.need-payment-notification',
            [
                'order' => $this->order,
                'url' => $this->url
            ]);
    }
}
