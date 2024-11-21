<?php

namespace App\Http\Resources\V1\PurchaseOrder\Supplier;

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
            'submitted_offers_count' => $this->submitted_offers_count,
            'approved_offers_count' => $this->approved_offers_count,
        ];
    }
}
