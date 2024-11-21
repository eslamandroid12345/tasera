<?php

namespace App\Http\Enums;

enum PurchaseOrderStatus : string
{
    use Enumable;

    case UNDER_REVIEW = 'under_review';
    case AVAILABLE = 'available';
//    case AVAILABLE_URGENTLY = 'available_urgently';
    case CANCELED = 'canceled';
    case EXPIRED = 'expired';
    case APPROVED = 'approved';

    public function t() {
        return match ($this) {
            self::UNDER_REVIEW => __('general.under_review'),
            self::AVAILABLE => __('general.available'),
//            self::AVAILABLE_URGENTLY => __('general.available_urgently'),
            self::CANCELED => __('general.canceled'),
            self::EXPIRED => __('general.expired'),
            self::APPROVED => __('general.approved'),
        };
    }

    public static function filterableValues()
    {
        return [
            self::AVAILABLE->value,
//            self::AVAILABLE_URGENTLY->value,
            self::EXPIRED->value,
            self::APPROVED->value,
            self::CANCELED->value
        ];
    }

    public static function isEditable($value)
    {
        return $value == self::AVAILABLE->value;
    }

    public static function isDelayable($value)
    {
        return in_array($value, [self::AVAILABLE->value, self::EXPIRED->value]);
    }

    public static function isApprovable($value)
    {
        return in_array($value, [self::AVAILABLE->value, self::EXPIRED->value]);
    }

    public static function isOfferable($value)
    {
        return $value == self::AVAILABLE->value;
    }
}
