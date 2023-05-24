<?php

namespace App\Jobs;

use App\Helpers\AppHelper;
use App\Models\UniqueOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NeedPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $order;
    private $url;
    public function __construct(UniqueOrder $order, $url)
    {
        $this->order = $order;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->order->status !== 'paid') {
            AppHelper::setMailConfig();
            Mail::to($this-> order->checkUnique->email)->send(new \App\Mail\NeedPayment($this->order, $this->url));
        }
    }
}
