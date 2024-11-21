<?php

namespace App\Http\Resources\V1\User;

use App\Http\Enums\CompanyType;
use App\Http\Resources\V1\Company\CompanyResource;
use App\Http\Resources\V1\Field\FieldResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private bool $withToken;

    public function __construct($resource, $withToken)
    {
        parent::__construct($resource);
        $this->withToken = $withToken;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company' => new CompanyResource($this->company),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'direct_manager_name' => $this->direct_manager_name,
            'direct_manager_email' => $this->direct_manager_email,
            'token' => $this->when($this->withToken, $this->token()),
        ];
    }
}
