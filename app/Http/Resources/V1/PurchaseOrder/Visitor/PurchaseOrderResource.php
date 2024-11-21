<?php

namespace App\Http\Resources\V1\PurchaseOrder\Visitor;

use App\Http\Enums\PurchaseOrderStatus;
use App\Http\Enums\PurchaseOrderType;
use App\Http\Resources\EnumableResource;
use App\Http\Resources\V1\Field\FieldResource;
use App\Http\Resources\V1\PurchaseOrder\Buyer\PurchaseOrderDemandUnitResource;
use App\Http\Resources\V1\PurchaseOrder\Buyer\PurchaseOrderInquiryResource;
use App\Http\Resources\V1\PurchaseOrder\PurchaseOrderSimpleUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
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
            'buyer' => new PurchaseOrderSimpleUserResource($this->company),
            'status' => new EnumableResource(PurchaseOrderStatus::from($this->status)),
            'type' => new EnumableResource(PurchaseOrderType::from($this->type)),
            'is_editable' => $this->is_editable,
            'is_delayable' => $this->is_delayable,
            'is_approvable' => $this->is_approvable,
            'is_offerable' => $this->is_offerable,
            'is_inquirable' => $this->is_inquirable,
            'views_count' => $this->views_count,
            'published_at' => $this->published_at,
            'closes_at' => $this->closes_at,
            'remaining_days' => $this->remaining_days,
            'remaining_seconds' => $this->remaining_seconds,
            'title' => $this->title,
            'description' => $this->description,
            'delivery_city' => $this->deliveryCity?->t('name'),
            'delivery_country' => $this->deliveryCity?->country?->t('name'),
            'delivery_duration' => $this->delivery_duration,
            'fields' => FieldResource::collection($this->fields),
            'demand_units' => $this->when($this->show_details, PurchaseOrderDemandUnitResource::collection($this->demandUnits)),
            'inquiries' => $this->when($this->show_details, PurchaseOrderInquiryResource::collection($this->publishedInquiries)),
            'is_already_offered' => $this->is_already_offered,
            'is_already_special_offered' => $this->is_already_special_offered,
        ];
    }
}
