<?php

namespace App\Jobs;

use App\Repository\StructureRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repository\UserRepositoryInterface;
use Mail;
use App\Mail\BuyerReportWeekly;

class SendEmailsWeekly implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Create a new job instance.
     */
    public $purchaseOrders,$email, $infos, $companyName;
    public function __construct($purchaseOrders,$email, $infos, $companyName)
    {
        $this->purchaseOrders = $purchaseOrders;
        $this->email = $email;
        $this->infos = $infos;
        $this->companyName = $companyName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'purchase_orders' => $this->purchaseOrders,
            'company_name' => $this->companyName,
            'infos' => $this->infos,
        ];
        Mail::to($this->email)->send(new BuyerReportWeekly($data));
        // sleep(3);
    }
}
