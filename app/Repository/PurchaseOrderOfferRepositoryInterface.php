<?php

namespace App\Repository;

interface PurchaseOrderOfferRepositoryInterface extends RepositoryInterface
{

    public function ensureOtherOffersNotApproved($purchaseOrderId, $approvedOfferId);

    public function approve($referenceId);

    public function getFiltered(
        ?string $keyword = null,
        ?string $sort = 'desc',
        ?array $statuses = null,
        ?array $fields = null,
        ?string $published_from = null,
        ?string $published_to = null,
        bool $mine = false
    );

    public function getNotPublished();

}
