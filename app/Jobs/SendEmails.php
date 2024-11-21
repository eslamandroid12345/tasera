<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\SupplierPurchaseOrderMail;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $users,$purchaseOrder,$infos;

    public function __construct($users,$purchaseOrder,$infos)
    {
        $this->users = $users;
        $this->purchaseOrder = $purchaseOrder;
        $this->infos = $infos;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        foreach ($this->users as $user)
        {
            $details2 = [
                            'infos' => $this->infos,
                            'title' => 'يوجد طلب شراء جديد فى مجالكم ',
                            'body' => $this->purchaseOrder,
                            'link' => env('purchase_orders').$this->purchaseOrder,
                            'user' => $user,
                        ];
            Mail::to($user->email)->send(new SupplierPurchaseOrderMail($details2));
            sleep(3);
        }
    }
}
