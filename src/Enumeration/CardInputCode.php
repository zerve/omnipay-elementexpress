<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * CardInputCode specifies the means in which the Card Number or Track Data was
 * acquired.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class CardInputCode extends AbstractEnumeration
{
    const __DEFAULT                      = 0;
    const UNKNOWN                        = 1;
    const MAGSTRIPE_READ                 = 2;
    const CONTACTLESS_MAGSTRIPE_READ     = 3;
    const MANUAL_KEYED                   = 4;
    const MANUAL_KEYED_MAGSTRIPE_FAILURE = 5;
}
