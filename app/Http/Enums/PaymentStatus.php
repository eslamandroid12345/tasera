<?php

namespace App\Http\Enums;

enum PaymentStatus : string
{
    use Enumable;

    case PENDING = 'pending';
    case BEING_REVIEWED = 'being_reviewed';
    case CONFIRMED = 'confirmed';
    case FAILED = 'failed';
    case REFUSED = 'refused';

    public function t() {
        return match ($this) {
            self::PENDING => __('general.pending'),
            self::BEING_REVIEWED => __('general.being_reviewed'),
            self::CONFIRMED => __('general.confirmed'),
            self::FAILED => __('general.failed'),
        };
    }

    public function invokable() {
        return match ($this) {
//            self::PENDING => null,
            self::BEING_REVIEWED => 'initiateNonActiveSubscription',
            self::CONFIRMED => 'initiateActiveSubscription',
            self::FAILED => 'failedPayment',
        };
    }
}
