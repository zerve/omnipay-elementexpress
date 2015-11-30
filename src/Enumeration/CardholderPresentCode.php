<?php

namespace Omnipay\Vantiv\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * CardholderPresentCode specifies the location of the cardholder at the time of
 * the transaction.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class CardholderPresentCode extends AbstractEnumeration
{
    const __DEFAULT     = 0;
    const UNKNOWN       = 1;
    const PRESENT       = 2;
    const NOT_PRESENT   = 3;
    const MAIL_ORDER    = 4;
    const PHONE_ORDER   = 5;
    const STANDING_AUTH = 6;
    const ECOMMERCE     = 7;
}
