<?php

namespace App\Http\Resources\V1\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyMetadataResource extends JsonResource
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
            'is_verified' => $this->is_verified,
            'website_url' => $this->website_url,
            'phone' => $this->phone,
            'about_us' => $this->about_us,
            'vision' => $this->vision,
            'message' => $this->message,
            'achievements_file' => $this->achievements_file_url,
        ];
    }
}
