<?php

namespace App\Http\Resources\V1\LoyaltyPoint;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LoyaltyPointCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_loyalty_points' => auth('api')->user()->company->total_loyalty_points,
            'loyalty_points' => $this->collection,
        ];
    }
}
