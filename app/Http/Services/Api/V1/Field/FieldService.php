<?php

namespace App\Http\Services\Api\V1\Field;

use App\Http\Resources\V1\Field\FieldResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\FieldRepositoryInterface;

class FieldService
{

    public function __construct(
        private readonly FieldRepositoryInterface $fieldRepository,
        private readonly GetService $get,
    )
    {
    }

    public function getInfo()
    {
        return $this->get->handle(FieldResource::class, $this->fieldRepository, 'getActive');
    }

}
