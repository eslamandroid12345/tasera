<?php

namespace App\Http\Enums;

enum PurchaseOrderType : string
{
    use Enumable;

    case DIRECT_PURCHASE = 'direct_purchase';
    case TENDER = 'tender';

    public function t() {
        return match ($this) {
            self::DIRECT_PURCHASE => __('general.direct_purchase'),
            self::TENDER => __('general.tender'),
        };
    }
}
