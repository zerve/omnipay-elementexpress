<?php

namespace Omnipay\ElementExpress\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * MarketCode specifies the industry type of the merchant. Set this to a value
 * of Default if you would like to use the MarketCode from the merchant profile.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class MarketCode extends AbstractEnumeration
{
    const __DEFAULT        = 0;
    const AUTO_RENTAL      = 1;
    const DIRECT_MARKETING = 2;
    const ECOMMERCE        = 3;
    const FOOD_RESTAURANT  = 4;
    const HOTEL_LODGING    = 5;
    const PETROLEUM        = 6;
    const RETAIL           = 7;
    const QSR              = 8;
}
