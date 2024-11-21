<?php

namespace App\Http\Resources\V1\PurchaseOrder\Buyer;

use App\Http\Resources\V1\PurchaseOrder\PurchaseOrderSimpleUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderInquiryResource extends JsonResource
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
            'company' => new PurchaseOrderSimpleUserResource($this->company),
            'content' => $this->content,
            'is_edited' => $this->is_edited,
            'created_at' => $this->created_at,
            'edited_at' => $this->updated_at,
            'reply' => $this->when(!$this->is_reply, new PurchaseOrderInquiryResource($this->reply)),
        ];
    }
}
