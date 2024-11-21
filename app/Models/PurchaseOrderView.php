<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderView extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function purchaseOrder() {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
