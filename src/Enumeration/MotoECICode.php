<?php

namespace Omnipay\Vantiv\Enumeration;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * MotoECI Code is used on MOTO and E-Commerce transactions to identify the type
 * of transaction, and the means in which it was obtained.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class MotoECICode extends AbstractEnumeration
{
    const __DEFAULT                                      = 0;
    const NOT_USED                                       = 1;
    const SINGLE                                         = 2;
    const RECURRING                                      = 3;
    const INSTALLMENT                                    = 4;
    const SECURE_ELECTRONIC_COMMERCE                     = 5;
    const NON_AUTHENTICATED_SECURE_TRANSACTION           = 6;
    const NON_AUTHENTICATED_SECURE_ECOMMERCE_TRANSACTION = 7;
    const NON_SECURE_ECOMMERCE_TRANSACTION               = 8;
}
