<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderInquiry extends Model
{
    protected $guarded = [];

    public function isEdited() : Attribute
    {
        return Attribute::get(function () {
            return $this->created_at != $this->updated_at;
        });
    }

    public function isReply() : Attribute
    {
        return Attribute::get(function () {
            return $this->parent_id !== null;
        });
    }

    public function createdAt() : Attribute
    {
        return Attribute::get(function ($value) {
            return Carbon::parse($value)->format('d/m/Y');
        });
    }

    public function createdAtValue() : Attribute
    {
        return Attribute::get(function () {
            return Carbon::parse($this->getRawOriginal('created_at'))->format('d-m-Y h:iA');
        });
    }

    public function updatedAt() : Attribute
    {
        return Attribute::get(function ($value) {
            return Carbon::parse($value)->format('d/m/Y');
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reply()
    {
        return $this->hasOne(PurchaseOrderInquiry::class, 'parent_id');
    }

    public function publishedReply()
    {
        return $this->reply()->where('is_published',true);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function scopeIsComment(Builder $query)
    {
        $query->whereNull('parent_id');
    }

    public function isRepliable() : Attribute
    {
        return Attribute::get(function () {
            return $this->parent_id == null && $this->purchaseOrder?->company_id == auth('api')?->user()?->company_id;
        });
    }
}
