<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * MarketCode specifies the industry type of the merchant. Set this to a value
 * of Default if you would like to use the MarketCode from the merchant profile.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class EncryptedFormat extends AbstractEnumeration
{
    const __DEFAULT = 0;
    const FORMAT_1  = 1;
    const FORMAT_2  = 2;
    const FORMAT_3  = 3;
    const FORMAT_4  = 4;
}
