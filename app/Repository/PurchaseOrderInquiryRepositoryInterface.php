<?php

namespace App\Repository;

interface PurchaseOrderInquiryRepositoryInterface extends RepositoryInterface
{

    public function isRepliable($inquiryId);

    public function getNotPublished();

}
