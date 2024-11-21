<?php

namespace App\Http\Resources\V1\PurchaseOrder;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderSimpleUserResource extends JsonResource
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
            'logo' => $this->logo_url,
            'name' => $this->t('name'),
            'city' => $this->city?->t('name'),
            'country' => $this->city?->country->t('name'),
            'is_verified' => $this->is_verified,
        ];
    }
}
