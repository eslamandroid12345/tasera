<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use LanguageToggle, HasFactory;

    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public $timestamps = false;

    public function companies() {
        return $this->belongsToMany(Company::class);
    }
    public function purchaseOrders() {
        return $this->belongsToMany(PurchaseOrder::class, 'field_purchase_order');
    }
}
