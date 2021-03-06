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
