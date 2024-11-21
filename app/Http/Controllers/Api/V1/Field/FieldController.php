<?php

namespace App\Http\Controllers\Api\V1\Field;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Field\FieldService;

class FieldController extends Controller
{
    public function __construct(
        private readonly FieldService $field,
    )
    {
    }

    public function getInfo()
    {
        return $this->field->getInfo();
    }
}
