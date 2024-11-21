<?php

namespace App\Http\Services\Api\V1\Package;

use App\Http\Resources\V1\Package\PackageResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\PackageRepositoryInterface;

class PackageService
{
    use Responser;

    public function __construct(
        private readonly PackageRepositoryInterface $packageRepository,
        private readonly GetService $get,
    )
    {
    }

    public function getPackages()
    {
        return $this->get->handle(PackageResource::class, $this->packageRepository, 'getActive');
    }
}
