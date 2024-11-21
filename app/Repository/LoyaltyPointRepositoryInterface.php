<?php

namespace App\Repository;

interface LoyaltyPointRepositoryInterface extends RepositoryInterface
{

    public function deleteByCompany($companyId);

    public function getByCompany($companyId);
}
