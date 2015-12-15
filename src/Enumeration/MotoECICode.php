<?php
/**
 * Copyright 2015 Zerve, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Omnipay\ElementExpress\Enumeration;

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
