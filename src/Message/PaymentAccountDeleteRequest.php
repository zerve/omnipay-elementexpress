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

namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\Model\PaymentAccountTrait;

/**
 * ElementExpress PaymentAccountDelete Request
 */
class PaymentAccountDeleteRequest extends AbstractServicesRequest
{
    use PaymentAccountTrait;

    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        return $this->domDocumentFactory('PaymentAccountDelete');
    }
}
