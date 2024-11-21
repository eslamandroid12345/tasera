<?php

namespace App\Http\Services\Api\V1\PurchaseOrder\Helpers;

use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderOfferRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\PurchaseOrderDemandUnitOfferRepositoryInterface;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderViewRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseOrderSupplierHelperService
{
    use Responser;

    public function __construct(
        private readonly PurchaseOrderRepositoryInterface $purchaseOrderRepository,
        private readonly PurchaseOrderOfferRepositoryInterface $purchaseOrderOfferRepository,
        private readonly PurchaseOrderDemandUnitOfferRepositoryInterface $purchaseOrderDemandUnitOfferRepository,
        private readonly PurchaseOrderViewRepositoryInterface    $purchaseOrderViewRepository,
        private readonly FileManagerService $fileManager
    )
    {
    }

    public function buildOffer(PurchaseOrderOfferRequest $request, $purchaseOrderId)
    {
        DB::beginTransaction();
        try {
            $offer = $this->initiateOffer($request, $purchaseOrderId);

            $this->assignOfferDemandUnits($request, $offer->id);

            DB::commit();
            return $this->responseSuccess(message: __('messages.Offer has been submitted successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::warning('ameer: ' . $e->getMessage());
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    private function initiateOffer(PurchaseOrderOfferRequest $request, $purchaseOrderId)
    {
        $data = $request->only(['purchase_order_tax_id', 'is_special']);

        $data['attachment'] = $this->fileManager->handle('attachment', 'purchase_orders/offers');

        return $this->purchaseOrderOfferRepository->create([
            'purchase_order_id' => $purchaseOrderId,
            'purchase_order_tax_id' => $data['purchase_order_tax_id'],
            'company_id' => auth('api')->user()->company_id,
            'user_id' => auth('api')->id(),
            'attachment' => $data['attachment'],
            'is_special' => $data['is_special'],
        ]);
    }

    private function assignOfferDemandUnits(PurchaseOrderOfferRequest $request, $purchaseOrderOfferId)
    {
        $demandUnits = $request->input('demand_units');
//        dd($demandUnits);
        foreach ($demandUnits as $demandUnit) {
            $this->purchaseOrderDemandUnitOfferRepository->create([
                'purchase_order_offer_id' => $purchaseOrderOfferId,
                'purchase_order_demand_unit_id' => $demandUnit['purchase_order_demand_unit_id'],
                'price' => $demandUnit['price']
            ]);
        }
    }

    public function incrementView($purchaseOrderId)
    {
        return $this->purchaseOrderViewRepository->increment($purchaseOrderId);
    }

}
