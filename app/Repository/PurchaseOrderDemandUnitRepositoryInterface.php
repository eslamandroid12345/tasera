<?php

namespace App\Repository;

interface PurchaseOrderDemandUnitRepositoryInterface extends RepositoryInterface
{

    public function deleteByPurchaseOrder($purchaseOrderId);

}
