<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * TerminalType specifies what type of conditions the Terminal is
 * operated in. For example: a card reader at a fuel pump would be considered
 * LocalUnattended.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class TerminalType extends AbstractEnumeration
{
    const UNKNOWN       = 0;
    const POINT_OF_SALE = 1;
    const ECOMMERCE     = 2;
    const MOTO          = 3;
    const FUEL_PUMP     = 4;
    const ATM           = 5;
    const VOICE         = 6;
}
