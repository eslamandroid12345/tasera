<?php

namespace App\Http\Resources\V1\PurchaseOrder\Buyer;

use App\Http\Resources\V1\Field\FieldResource;
use App\Http\Resources\V1\PurchaseOrder\PurchaseOrderSimpleUserResource;
use App\Http\Resources\V1\PurchaseOrder\PurchaseOrderTaxResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reference_id' => $this->reference_id,
            'supplier' => new PurchaseOrderSimpleUserResource($this->user->company),
            'created_at' => $this->created_at,
            'fields' => FieldResource::collection($this->company?->fields),
            'has_attachment' => $this->has_attachment,
            'attachment' => $this->attachment_url,
            'is_special' => $this->is_special,
            'demand_units' => PurchaseOrderDemandUnitOfferResource::collection($this->demandUnits),
            'tax' => new PurchaseOrderTaxResource($this->tax),
            'total_price_without_tax' => $this->total_price_without_tax,
            'total_price' => $this->total_price,
            'is_approved' => $this->is_approved,
        ];
    }
}
