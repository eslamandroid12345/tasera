<?php

namespace App\Http\Services\Api\V1\PurchaseOrder;

use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderApprovalRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderDelayRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderFilterRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderInquiryRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderRequest;
use App\Http\Resources\V1\PurchaseOrder\Buyer\PurchaseOrderStatisticResource;
use App\Http\Resources\V1\PurchaseOrder\Buyer\PurchaseOrderResource;
use App\Http\Resources\V1\PurchaseOrder\Buyer\SimplePurchaseOrderCollection;
use App\Http\Services\Api\V1\PurchaseOrder\Helpers\PurchaseOrderBuyerHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\FieldPurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use App\Repository\PurchaseOrderInquiryRepositoryInterface;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseOrderBuyerService
{
    use Responser;

    public function __construct(
        private readonly PurchaseOrderRepositoryInterface           $purchaseOrderRepository,
        private readonly FieldPurchaseOrderRepositoryInterface      $fieldPurchaseOrderRepository,
        private readonly PurchaseOrderDemandUnitRepositoryInterface $purchaseOrderDemandUnitRepository,
        private readonly PurchaseOrderOfferRepositoryInterface      $purchaseOrderOfferRepository,
        private readonly PurchaseOrderInquiryRepositoryInterface    $purchaseOrderInquiryRepository,
        private readonly PurchaseOrderBuyerHelperService            $helper,
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
                true
            ],
            true
        );
    }

    public function getMyStatistics()
    {
        return $this->responseSuccess(data: new PurchaseOrderStatisticResource(auth('api')->user()->company));
    }

    public function create(PurchaseOrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $purchaseOrder = $this->helper->buildPurchaseOrder($request);

            DB::commit();
            return $this->responseSuccess(message: __('messages.The purchase order has been created and will be published after review'), data: new PurchaseOrderResource($purchaseOrder));
        } catch (Exception $e) {
            DB::rollBack();
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function show($referenceId)
    {
        return $this->get->handle(PurchaseOrderResource::class, $this->purchaseOrderRepository, 'getMyOrder', [$referenceId], true);
    }

    public function update(PurchaseOrderRequest $request, $referenceId)
    {
        DB::beginTransaction();
        try {
            $purchaseOrder = $this->purchaseOrderRepository->first('reference_id', $referenceId);

            if ($purchaseOrder->is_editable) {
                $this->helper->updatePurchaseOrder($request, $referenceId);
                DB::commit();

                $purchaseOrder = $this->purchaseOrderRepository->first('reference_id', $referenceId);
                return $this->responseSuccess(message: __('messages.updated successfully'), data: new PurchaseOrderResource($purchaseOrder));
            } else {
                return $this->responseFail(401, __('messages.You are not authorized to access this resource'));
            }
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function approve(PurchaseOrderApprovalRequest $request, $referenceId)
    {
        $purchaseOrder = $this->purchaseOrderRepository->first('reference_id', $referenceId);

        if ($purchaseOrder->is_approvable)
        {

            $data = $request->validated();

            $this->purchaseOrderRepository->approve($referenceId);
            $this->purchaseOrderOfferRepository->approve($data['reference_id']);

            return $this->responseSuccess(message: __('messages.Offer is approved successfully'));
        }
        else
        {
            return $this->responseFail(401, __('messages.You are not authorized to access this resource'));
        }
    }

    public function replyInquiry(PurchaseOrderInquiryRequest $request, $purchaseOrderId, $inquiryId)
    {
        $purchaseOrderInquiry = $this->purchaseOrderInquiryRepository->getById($inquiryId);

        if ($purchaseOrderInquiry->is_repliable) {
            $data = $request->validated();

            $purchaseOrder = $this->purchaseOrderRepository->getMyOrder($purchaseOrderId);

            $this->purchaseOrderInquiryRepository->create([
                'company_id' => auth('api')->user()->company_id,
                'purchase_order_id' => $purchaseOrder->id,
                'content' => $data['content'],
                'parent_id' => $inquiryId,
                'is_published' => true,
            ]);

            return $this->responseSuccess();
        } else {
            return $this->responseFail(401, __('messages.Something went wrong'));
        }
    }

    public function delay(PurchaseOrderDelayRequest $request, $purchaseOrderId)
    {
        $data = $request->validated();

        $data['closes_at'] = Carbon::parse($data['closes_at'])->format('Y-m-d H:i:s');

        $purchaseOrder = $this->purchaseOrderRepository->getMyOrder($purchaseOrderId);

        $closes_at = Carbon::parse($purchaseOrder->closes_at_value);

        $isFuture = Carbon::parse($data['closes_at'])->isAfter($closes_at) && Carbon::parse($data['closes_at'])->isFuture();

        if (!$purchaseOrder->is_delayable)
            return $this->responseFail(message: __('messages.This purchase order cannot be delayed'));

        if (!$isFuture)
            return $this->responseFail(message: __('messages.Delay close date must be after the original close date'));

        $this->purchaseOrderRepository->delay($purchaseOrder->reference_id, $data['closes_at']);
        return $this->responseSuccess(message: __('messages.Purchase order delayed successfully', ['reference_id' => $purchaseOrderId]));
    }
}
