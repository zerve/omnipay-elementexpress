<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * ReversalType specifies the type of reversal that is being performed.
 */
final class ReversalType extends AbstractEnumeration
{
    const SYSTEM  = 0;
    const FULL    = 1;
    const PARTIAL = 2;
}
