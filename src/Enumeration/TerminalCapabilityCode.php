<?php

namespace Omnipay\Vantiv\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * TerminalCapabilityCode specifies what the capabilities of the Terminal are.
 * For example: an E-Commerce website would be considered KeyEntered.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class TerminalCapabilityCode extends AbstractEnumeration
{
    const __DEFAULT                    = 0;
    const UNKNOWN                      = 1;
    const NO_TERMINAL                  = 2;
    const MAGSTRIPE_READER             = 3;
    const CONTACTLESS_MAGSTRIPE_READER = 4;
    const KEY_ENTERED                  = 5;
}
