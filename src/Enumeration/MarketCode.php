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
