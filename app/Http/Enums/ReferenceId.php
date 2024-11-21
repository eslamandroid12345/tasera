<?php

namespace App\Http\Enums;

enum ReferenceId: string
{
    use Enumable;

    case SUPPLIER = 'S'; //S000001 → S999999
    case BUYER = 'P'; //P000001 → P999999
    case PURCHASE_ORDER = 'RFQ'; //RFQ00000000001→ RFQ99999999999
    case OPPORTUNITY = 'QUT'; //QUT00000000001→ QUT99999999999

}
