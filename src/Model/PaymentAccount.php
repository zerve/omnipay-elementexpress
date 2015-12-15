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

namespace Omnipay\ElementExpress\Model;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;

class PaymentAccount extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [

            // Elements corresponding directly with standard Omnipay parameter
            // names use those same names here instead of ElementExpress names.

            'cardReference'                 => '', // ElementExpress "PaymentAccountID"

            // Remaining elements correspond to ElementExpress parameters.

            'PaymentAccountType'            => '',
            'PaymentAccountReferenceNumber' => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('PaymentAccount'));
        $node->appendChild(new \DOMElement('PaymentAccountID', $this['cardReference']));
        if (!empty($this['PaymentAccountType'])) {
            $node->appendChild(new \DOMElement('PaymentAccountType', $this['PaymentAccountType']->value()));
        }
        $node->appendChild(new \DOMElement('PaymentAccountReferenceNumber', $this['PaymentAccountReferenceNumber']));
    }


    /**
     * Model validation ensures that any data that is present in the model is
     * formatted correctly. No business logic validation is performed at this
     * level.
     *
     * @throws InvalidRequestException if validation fails.
     */
    public function validate()
    {
        if (strlen($this['cardReference']) && !preg_match('/^.{1,50}$/', $this['cardReference'])) {
            throw new InvalidRequestException('cardReference should have 50 or fewer characters');
        }

        if (isset($this['PaymentAccountType']) && !$this['PaymentAccountType'] instanceof PaymentAccountType) {
            throw new InvalidRequestException('Invalid value for PaymentAccountType');
        }

        if (strlen($this['PaymentAccountReferenceNumber'])) {
            if (!preg_match('/^.{1,50}$/', $this['PaymentAccountReferenceNumber'])) {
                throw new InvalidRequestException('PaymentAccountReferenceNumber should have 50 or fewer characters');
            }
        }
    }
}
