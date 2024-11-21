<?php

namespace App\Http\Resources\V1\PurchaseOrder\Buyer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderDemandUnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'type' => $this->type?->t('name'),
            'details' => $this->details,
            'attachment' => $this->attachment_url,
        ];
    }
}
