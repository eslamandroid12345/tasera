<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDemandUnit extends Model
{
    protected $guarded = [];

    public function attachmentUrl() : Attribute
    {
        return Attribute::get(fn() => $this->attachment !== null ? url($this->attachment) : null);
    }

    public function purchaseOrder() {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function type() {
        return $this->belongsTo(PurchaseOrderDemandUnitType::class, 'type_id');
    }

    public function demandUnitOffers()
    {
        return $this->hasMany(PurchaseOrderDemandUnitOffer::class);
    }
}
