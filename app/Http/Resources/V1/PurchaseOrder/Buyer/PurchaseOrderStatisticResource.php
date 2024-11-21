<?php

namespace App\Http\Resources\V1\PurchaseOrder\Buyer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderStatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'under_review_purchase_orders_count' => $this->under_review_purchase_orders_count,
            'available_purchase_orders_count' => $this->available_purchase_orders_count,
            'canceled_purchase_orders_count' => $this->canceled_purchase_orders_count,
            'expired_purchase_orders_count' => $this->expired_purchase_orders_count,
            'approved_purchase_orders_count' => $this->approved_purchase_orders_count,
        ];
    }
}
