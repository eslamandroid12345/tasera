<?php

namespace App\Repository;

interface CompanyRepositoryInterface extends RepositoryInterface
{

    public function syncFields($id, array $fields);
    public function getBuyers($perPage);

    public function paginatedType($type);
}
