<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDemandUnitOffer extends Model
{
    protected $guarded = [];

    public function offer()
    {
        return $this->belongsTo(PurchaseOrderOffer::class, 'purchase_order_offer_id');
    }

    public function demandUnit()
    {
        return $this->belongsTo(PurchaseOrderDemandUnit::class, 'purchase_order_demand_unit_id');
    }
}
