<?php

namespace App\Http\Services\Api\V1\PurchaseOrder;

use App\Http\Enums\CompanyType;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderFilterRequest;
use App\Http\Resources\V1\PurchaseOrder\Visitor\PurchaseOrderResource;
use App\Http\Resources\V1\PurchaseOrder\Visitor\SimplePurchaseOrderCollection;
use App\Http\Resources\V1\PurchaseOrder\Visitor\SimplePurchaseOrderResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\FieldPurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderViewRepositoryInterface;

class PurchaseOrderService
{
    use Responser;

    public function __construct(
        private readonly PurchaseOrderRepositoryInterface           $purchaseOrderRepository,
        private readonly FieldPurchaseOrderRepositoryInterface      $fieldPurchaseOrderRepository,
        private readonly PurchaseOrderDemandUnitRepositoryInterface $purchaseOrderDemandUnitRepository,
        private readonly PurchaseOrderViewRepositoryInterface       $purchaseOrderViewRepository,
        private readonly GetService                                 $get,
        private readonly FileManagerService                         $fileManager,
    )
    {
    }

    public function getFilteredPurchaseOrders(PurchaseOrderFilterRequest $request)
    {
        $request['sort'] = $request['sort'] ?? 'desc';
        return $this->get->handle(
            SimplePurchaseOrderCollection::class,
            $this->purchaseOrderRepository,
            'getFiltered',
            [
                $request['keyword'],
                $request['sort'],
                $request['statuses'],
                $request['fields'],
                $request['published_from'],
                $request['published_to'],
                false,
                8
            ],
            true
        );
    }

    public function show($referenceId)
    {
        if (auth('api')?->user()?->company?->type == CompanyType::SUPPLIER->value) {
            $purchaseOrder = $this->purchaseOrderRepository->first('reference_id', $referenceId);
            $this->purchaseOrderViewRepository->increment($purchaseOrder->id);
        }
        return $this->get->handle(PurchaseOrderResource::class, $this->purchaseOrderRepository, 'first', ['reference_id', $referenceId], true);
    }

    public function getLatestPurchaseOrders()
    {
        return $this->get->handle(SimplePurchaseOrderResource::class, $this->purchaseOrderRepository, 'getLatest');
    }
}
