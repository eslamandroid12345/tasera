<?php

namespace App\Http\Resources\V1\LoyaltyPoint;

use App\Http\Enums\LoyaltyPointsSetting;
use App\Http\Resources\EnumableResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoyaltyPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'referral_company_name' => $this->referralCompany->t('name'),
            'type' => new EnumableResource(LoyaltyPointsSetting::from($this->setting->name)),
            'date' => $this->date,
            'points' => $this->points,
        ];
    }
}
