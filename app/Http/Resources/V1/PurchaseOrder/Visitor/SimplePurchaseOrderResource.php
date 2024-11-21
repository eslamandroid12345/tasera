<?php

namespace App\Http\Resources\V1\PurchaseOrder\Visitor;

use App\Http\Enums\PurchaseOrderStatus;
use App\Http\Enums\PurchaseOrderType;
use App\Http\Resources\EnumableResource;
use App\Http\Resources\V1\Field\FieldResource;
use App\Http\Resources\V1\PurchaseOrder\PurchaseOrderSimpleUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimplePurchaseOrderResource extends JsonResource
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
            'buyer' => $this->when($this->show_details, new PurchaseOrderSimpleUserResource($this->company)),
            'views_count' => $this->views_count,
            'delivery_city' => $this->when($this->show_details, $this->deliveryCity?->t('name')),
            'delivery_country' => $this->when($this->show_details, $this->deliveryCity?->country?->t('name')),
            'title' => $this->title,
            'fields' => FieldResource::collection($this->fields),
            'status' => new EnumableResource(PurchaseOrderStatus::from($this->status)),
            'type' => new EnumableResource(PurchaseOrderType::from($this->type)),
            'remaining_days' => $this->remaining_days,
            'remaining_seconds' => $this->remaining_seconds,
            'is_mine' => $this->is_mine,
        ];
    }
}
