<?php

namespace App\Http\Enums;

enum PaymentMethod : string
{
    use Enumable;

    case CARD = 'card';
    case APPLE_PAY = 'apple_pay';
    case BANK_TRANSFER = 'bank_transfer';
    case MADA = 'mada';

    public function t() {
        return match ($this) {
            self::CARD => __('general.card'),
            self::APPLE_PAY => __('general.apple_pay'),
            self::BANK_TRANSFER => __('general.bank_transfer'),
            self::MADA => __('general.mada'),
        };
    }

    public function validationRules() : array
    {
        return match ($this) {
            self::CARD, self::APPLE_PAY, self::MADA => [],
            self::BANK_TRANSFER => [
                'transfer_image' => ['required', 'exclude', 'file', 'mimes:jpg,jpeg,png', 'max:512'],
                'bank_account_name' => ['required', 'string'],
                'bank_account_number' => ['required'],
                'from_bank' => ['required', 'string'],
                'to_bank' => ['required', 'string'],
                'transfer_date' => ['required', 'date', 'date_format:Y-m-d'],
                'transfer_time' => ['required', 'date_format:H:i'],
            ],
        };
    }

    public function invokable()
    {
        return match ($this) {
            self::CARD => 'card',
            self::APPLE_PAY => 'applePay',
            self::BANK_TRANSFER => 'bankTransfer',
            self::MADA => 'mada',
        };
    }
}
