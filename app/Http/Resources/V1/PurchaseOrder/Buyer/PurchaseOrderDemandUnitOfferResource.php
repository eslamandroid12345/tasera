<?php

namespace App\Http\Resources\V1\PurchaseOrder\Buyer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderDemandUnitOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd($this->demandUnit);
        return [
            'name' => $this->demandUnit?->name,
            'quantity' => $this->demandUnit?->quantity,
            'unit_type' => $this->demandUnit?->type?->t('name'),
            'details' => $this->demandUnit?->details,
            'attachment' => $this->demandUnit?->attachment_url,
            'unit_price_without_tax' => $this->price,
            'total_price_without_tax' => $this->demandUnit?->quantity * $this->price,
        ];
    }
}
