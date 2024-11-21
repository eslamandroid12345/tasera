<?php

namespace App\Console\Commands;

use App\Repository\PurchaseOrderRepositoryInterface;
use Illuminate\Console\Command;

class SettlePurchaseOrderStatus extends Command
{
    public function __construct(
        private readonly PurchaseOrderRepositoryInterface $purchaseOrderRepository,
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:settle-purchase-order-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Settle purchase orders\' statuses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->purchaseOrderRepository->settleAvailableOrders();
    }
}
