<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * CardPresentCode specifies the location of the card at the time of the
 * transaction.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class CardPresentCode extends AbstractEnumeration
{
    const __DEFAULT   = 0;
    const UNKNOWN     = 1;
    const PRESENT     = 2;
    const NOT_PRESENT = 3;
}
