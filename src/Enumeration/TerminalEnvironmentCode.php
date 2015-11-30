<?php

namespace Omnipay\Vantiv\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * TerminalEnvironmentCode specifies what type of conditions the Terminal is
 * operated in. For example: a card reader at a fuel pump would be considered
 * LocalUnattended.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class TerminalEnvironmentCode extends AbstractEnumeration
{
    const __DEFAULT         = 0;
    const NO_TERMINAL       = 1;
    const LOCAL_ATTENDED    = 2;
    const LOCAL_UNATTENDED  = 3;
    const REMOTE_ATTENDED   = 4;
    const REMOTE_UNATTENDED = 5;
    const ECOMMERCE         = 6;
}
