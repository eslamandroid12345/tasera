<?php

namespace App\Repository;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function updatePasswordByEmail($email, $password);
    public function getLatestUserLogin($compaany_id);
    public function getCommonSuppliers($purchase_order);
    public function getAllUserBuyerReport();
}
