<?php

namespace App\Repository\Eloquent;

use App\Models\PurchaseOrderDemandUnitOffer;
use App\Repository\PurchaseOrderDemandUnitOfferRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDemandUnitOfferRepository extends Repository implements PurchaseOrderDemandUnitOfferRepositoryInterface
{
    protected Model $model;

    public function __construct(PurchaseOrderDemandUnitOffer $model)
    {
        parent::__construct($model);
    }
}
