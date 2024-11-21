<?php

namespace App\Http\Controllers\Api\V1\Structure;

class AboutController extends StructureController
{
    protected string $contentKey = 'about';
    protected array $with = [
        'home' => ['statistics'],
    ];
}
