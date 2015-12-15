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
 * CardPresentCode specifies the location of the card at the time of the
 * transaction.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class CardPresentCode extends AbstractEnumeration
{
    const __DEFAULT   = 0;
    const UNKNOWN     = 1;
    const PRESENT     = 2;
    const NOT_PRESENT = 3;
}
