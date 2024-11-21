<?php

namespace App\Repository;

interface PurchaseOrderViewRepositoryInterface extends RepositoryInterface
{

    public function increment($purchaseOrderId);

}
