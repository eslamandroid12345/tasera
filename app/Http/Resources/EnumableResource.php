<?php

namespace App\Http\Resources;

use App\Http\Enums\CompanyType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnumableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->value,
            'value' => $this->t(),
        ];
    }
}
