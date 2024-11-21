<?php

namespace App\Http\Resources\V1\PurchaseOrder\Supplier;

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
            'reference_id' => $this->purchaseOrder?->reference_id,
            'buyer' => $this->when($this->show_details, new PurchaseOrderSimpleUserResource($this->purchaseOrder?->company)),
            'created_at' => $this->created_at_date,
            'views_count' => $this->purchaseOrder?->views_count,
            'title' => $this->purchaseOrder?->title,
            'fields' => FieldResource::collection($this->purchaseOrder?->fields),
            'status' => new EnumableResource(PurchaseOrderStatus::from($this->purchaseOrder?->status)),
            'type' => new EnumableResource(PurchaseOrderType::from($this->purchaseOrder?->type)),
            'remaining_days' => $this->purchaseOrder?->remaining_days,
            'remaining_seconds' => $this->purchaseOrder?->remaining_seconds,
        ];
    }
}
