<?php

namespace App\Repository;

interface CityRepositoryInterface extends RepositoryInterface
{
    public function paginateCountryCities($country_id);
}
