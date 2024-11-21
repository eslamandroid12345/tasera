<?php

namespace App\Http\Services\Api\V1\PurchaseOrder;

use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderFilterRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderInquiryRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderOfferRequest;
use App\Http\Resources\V1\PurchaseOrder\Supplier\PurchaseOrderResource;
use App\Http\Resources\V1\PurchaseOrder\Supplier\PurchaseOrderStatisticResource;
use App\Http\Resources\V1\PurchaseOrder\Supplier\SimplePurchaseOrderCollection;
use App\Http\Services\Api\V1\PurchaseOrder\Helpers\PurchaseOrderSupplierHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\PurchaseOrderInquiryRepositoryInterface;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderViewRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class PurchaseOrderSupplierService
{
    use Responser;

    public function __construct(
        private readonly PurchaseOrderRepositoryInterface        $purchaseOrderRepository,
        private readonly PurchaseOrderOfferRepositoryInterface   $purchaseOrderOfferRepository,
        private readonly PurchaseOrderInquiryRepositoryInterface $purchaseOrderInquiryRepository,
        private readonly PurchaseOrderSupplierHelperService      $helper,
        private readonly GetService                              $get,
        private readonly FileManagerService                      $fileManager,
    )
    {
    }

    public function getMyFilteredOffers(PurchaseOrderFilterRequest $request)
    {
        return $this->get->handle(
            SimplePurchaseOrderCollection::class,
            $this->purchaseOrderOfferRepository,
            'getFiltered',
            [
                $request['keyword'],
                $request['sort'],
                $request['statuses'],
                $request['fields'],
                $request['published_from'],
                $request['published_to'],
                true
            ],
            true
        );
    }

    public function getMyStatistics()
    {
        return $this->responseSuccess(data: new PurchaseOrderStatisticResource(auth('api')->user()->company));
    }

    public function show($referenceId)
    {
        $purchaseOrder = $this->purchaseOrderRepository->first('reference_id', $referenceId, ['id']);
        $this->helper->incrementView($purchaseOrder->id);

        return $this->get->handle(PurchaseOrderResource::class, $this->purchaseOrderRepository, 'first', ['reference_id', $referenceId], true);
    }

    public function inquire(PurchaseOrderInquiryRequest $request, $referenceId)
    {
        $purchaseOrder = $this->purchaseOrderRepository->first('reference_id', $referenceId, ['id']);

        if ($purchaseOrder->is_inquirable) {
            $data = $request->validated();

            $this->purchaseOrderInquiryRepository->create([
                'company_id' => auth('api')->user()->company_id,
                'purchase_order_id' => $purchaseOrder->id,
                'content' => $data['content'],
                'parent_id' => null,
                'is_published' => false,
            ]);

            return $this->responseSuccess(message: __('messages.Your inquiry has been submitted and will be published after review'));
        } else {
            return $this->responseFail(401, __('messages.You are not authorized to access this resource'));
        }
    }

    public function offer(PurchaseOrderOfferRequest $request, $referenceId)
    {
        $purchaseOrder = $this->purchaseOrderRepository->first('reference_id', $referenceId);

        if ($purchaseOrder->is_offerable) {
            return $this->helper->buildOffer($request, $purchaseOrder->id);
        } else {
            return $this->responseFail(401, __('messages.You have already submitted an offer before'));
        }
    }

}
