<?php

namespace App\Repository;

interface FieldPurchaseOrderRepositoryInterface extends RepositoryInterface
{

    public function deleteByPurchaseOrder($purchaseOrderId);

}
