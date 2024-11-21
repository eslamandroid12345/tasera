<?php

namespace App\Http\Enums;

enum LoyaltyPointsSetting : string
{
    use Enumable;

    case REGISTER = 'register';
    case PURCHASE_ORDER_APPROVAL = 'purchase_order_approval';

    public function t()
    {
        return match ($this) {
            self::REGISTER => __('general.loyalty points.register'),
            self::PURCHASE_ORDER_APPROVAL => __('general.loyalty points.purchase_order_approval'),
        };
    }

}
