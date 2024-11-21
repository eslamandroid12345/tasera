<?php

namespace App\Http\Resources\V1\Subscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'package_name' => $this->package?->t('name'),
            'start_at' => $this->created_at,
            'end_at' => $this->ends_at,
            'used_special_offers_count' => $this->company?->used_special_offers_count,
            'remaining_special_offers_count' => $this->company?->remaining_special_offers_humanized_count
        ];
    }
}
