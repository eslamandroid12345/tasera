<?php

namespace App\Http\Resources\V1\Company;

use App\Http\Enums\CompanyType;
use App\Http\Resources\EnumableResource;
use App\Http\Resources\V1\Field\FieldResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'type' => new EnumableResource(CompanyType::from($this->type)),
            'name' => $this->t('name'),
            'fields' => FieldResource::collection($this->fields),
            'website_url' => $this->website_url,
            'logo' => $this->logo_url,
            'is_verified' => $this->is_verified,
//            'authorization_file' => $this->authorization_file_url,
//            'authorization_approval_file' => $this->authorization_approval_file_url,
            'commercial_registration_no' => $this->commercial_registration_no,
            'commercial_registration_image' => $this->commercial_registration_image_url,
            'commercial_registration_expiry_date' => $this->commercial_registration_expiry_date,
            'is_tax_exempt' => $this->is_tax_exempt,
            'tax_registration_no' => $this->tax_registration_no,
            'tax_registration_image' => $this->tax_registration_image_url,
            'country' => $this->city?->country?->t('name'),
            'city' => $this->city?->t('name'),
            'phone' => $this->phone,
            'bank_details_file' => $this->bank_details_file_url,
            'about_us' => $this->about_us,
            'vision' => $this->vision,
            'message' => $this->message,
            'achievements_file' => $this->achievements_file_url,
            'can_subscribe' => $this->can_subscribe,
            'is_subscribed' => $this->is_subscribed,
            'has_loyalty_points' => $this->has_loyalty_points,
            'can_add_sub_user' => $this->can_add_sub_user,
            'is_current_package_fallback' => $this->whenNotNull($this->is_current_package_fallback),
            'can_make_special_offer' => $this->whenNotNull($this->can_make_special_offer),
        ];
    }
}
