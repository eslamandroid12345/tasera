<?php

namespace App\Http\Services\Api\V1\Country;

use App\Http\Resources\V1\Country\CountryResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\CountryRepositoryInterface;

class CountryService
{
    public function __construct(
        private readonly CountryRepositoryInterface $countryRepository,
        private readonly GetService $get,
    )
    {
    }

    public function getInfo()
    {
        return $this->get->handle(CountryResource::class, $this->countryRepository);
    }

}
