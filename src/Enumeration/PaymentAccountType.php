<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * PaymentAccountType indicates the type of Payment Account that is being
 * created.
 */
final class PaymentAccountType extends AbstractEnumeration
{
    const CREDIT_CARD = 0;
    const CHECKING    = 1;
    const SAVINGS     = 2;
    const ACH         = 3;
    const OTHER       = 4;
}
