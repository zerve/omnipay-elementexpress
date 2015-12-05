<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * CardholderPresentCode specifies the location of the cardholder at the time of
 * the transaction.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class PaymentAccountType extends AbstractEnumeration
{
    const CREDIT_CARD = 0;
    const CHECKING    = 1;
    const SAVINGS     = 2;
    const ACH         = 3;
    const OTHER       = 4;
}
