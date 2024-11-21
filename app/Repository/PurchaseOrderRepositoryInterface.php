<?php

namespace App\Repository;

interface PurchaseOrderRepositoryInterface extends RepositoryInterface
{

    public function getFiltered(
        string $keyword = null,
        string $sort = null,
        array $statuses = null,
        array $fields = null,
        string $published_from = null,
        string $published_to = null,
        bool $mine = false,
        int $perPage = 9,
    );

    public function getMyOrder($referenceId);

    public function isMyOrder($referenceId);

    public function delay($referenceId, $delayDate);

    public function getLatest();

    public function settleAvailableOrders();

    public function getlatestItem();
}
