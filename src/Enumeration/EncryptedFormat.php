<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * EncryptedFormat specifies the encryption format of the device used for the
 * transaction.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class EncryptedFormat extends AbstractEnumeration
{
    const __DEFAULT = 0;
    const FORMAT_1  = 1; // Magtek
    const FORMAT_2  = 2; // Ingenico DPP
    const FORMAT_3  = 3; // Ingenico On-Guard
    const FORMAT_4  = 4; // ID Tech
}
