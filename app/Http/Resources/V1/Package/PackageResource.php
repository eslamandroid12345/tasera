<?php

namespace App\Http\Resources\V1\Package;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'name' => $this->t('name'),
            'color' => $this->color,
            'price' => $this->price,
            'subscription_months' => $this->subscription_months,
            'special_offers' => $this->special_offers,
            'can_add_sub_user' => $this->can_add_sub_user,
            'has_verified_badge' => $this->has_verified_badge,
            'can_view_company_file' => $this->can_view_company_file,
            'is_fallback' => $this->is_fallback,
            'is_current_subscription' => $this->whenNotNull($this->is_current_subscription),
        ];
    }
}
