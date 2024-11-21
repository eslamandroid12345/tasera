<?php

namespace App\Repository\Eloquent;

use App\Models\PurchaseOrderTax;
use App\Repository\PurchaseOrderTaxRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderTaxRepository extends Repository implements PurchaseOrderTaxRepositoryInterface
{
    protected Model $model;

    public function __construct(PurchaseOrderTax $model)
    {
        parent::__construct($model);
    }
}
