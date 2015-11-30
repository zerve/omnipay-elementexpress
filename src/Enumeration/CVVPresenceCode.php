<?php

namespace Omnipay\Vantiv\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * CVVPresenceCode specifies the status of the CVV code from the consumer card
 * as it pertains to the transaction. If the CVV code from the card is not
 * included in the transaction, it is recommended that this code be set to the
 * reason why.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class CVVPresenceCode extends AbstractEnumeration
{
    const __DEFAULT          = 0;
    const NOT_PROVIDED       = 1;
    const PROVIDED           = 2;
    const ILLEGIBLE          = 3;
    const CUSTOMER_ILLEGIBLE = 4;
}
