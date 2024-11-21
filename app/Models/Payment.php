<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function methodValue():Attribute {
        return Attribute::get(get: function (){
            if($this->method=='card')
                return __('dashboard.card');
            else if ($this->method=='apple_pay')
                return __('dashboard.apple_pay');
            else if ($this->method=='bank_transfer')
                return __('dashboard.bank_transfer');
            else if ($this->method=='mada')
                return __('dashboard.mada');
        });
    }
    public function statusValue():Attribute {
        return Attribute::get(get: function (){
            if($this->status=='pending')
                return __('dashboard.pending');
            else if ($this->status=='being_reviewed')
                return __('dashboard.being_reviewed');
            else if ($this->status=='confirmed')
                return __('dashboard.confirmed');
            else if ($this->status=='failed')
                return __('dashboard.failed');
            else if ($this->status=='refused')
                return __('dashboard.refused');
        });
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
}
