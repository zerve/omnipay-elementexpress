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
 * CVVPresenceCode specifies the status of the CVV code from the consumer card
 * as it pertains to the transaction. If the CVV code from the card is not
 * included in the transaction, it is recommended that this code be set to the
 * reason why.
 *
 * 'Default' is a PHP reserved word, so the string '__DEFAULT' is used instead.
 */
final class CVVPresenceCode extends AbstractEnumeration
{
    const __DEFAULT          = 0;
    const NOT_PROVIDED       = 1;
    const PROVIDED           = 2;
    const ILLEGIBLE          = 3;
    const CUSTOMER_ILLEGIBLE = 4;
}
