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

class PaymentAccountParameters extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [
            'PaymentAccountID'              => '',
            'PaymentAccountType'            => '',
            'PaymentAccountReferenceNumber' => '',
            'PaymentBrand'                  => '',
            'ExpirationMonthBegin'          => '',
            'ExpirationMonthEnd'            => '',
            'ExpirationYearBegin'           => '',
            'ExpirationYearEnd'             => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('PaymentAccountParameters'));
        $node->appendChild(new \DOMElement('PaymentAccountID', $this['PaymentAccountID']));
        if (!empty($this['PaymentAccountType'])) {
            $node->appendChild(new \DOMElement('PaymentAccountType', $this['PaymentAccountType']->value()));
        }
        $node->appendChild(new \DOMElement('PaymentAccountReferenceNumber', $this['PaymentAccountReferenceNumber']));
        $node->appendChild(new \DOMElement('PaymentBrand', $this['PaymentBrand']));
        $node->appendChild(new \DOMElement('ExpirationMonthBegin', $this['ExpirationMonthBegin']));
        $node->appendChild(new \DOMElement('ExpirationMonthEnd', $this['ExpirationMonthEnd']));
        $node->appendChild(new \DOMElement('ExpirationYearBegin', $this['ExpirationYearBegin']));
        $node->appendChild(new \DOMElement('ExpirationYearEnd', $this['ExpirationYearEnd']));
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
        if (strlen($this['PaymentAccountID']) && !preg_match('/^.{1,50}$/', $this['PaymentAccountID'])) {
            throw new InvalidRequestException('PaymentAccountID should have 50 or fewer characters');
        }

        if (isset($this['PaymentAccountType']) && !$this['PaymentAccountType'] instanceof PaymentAccountType) {
            throw new InvalidRequestException('Invalid value for PaymentAccountType');
        }

        if (strlen($this['PaymentAccountReferenceNumber'])) {
            if (!preg_match('/^.{1,50}$/', $this['PaymentAccountReferenceNumber'])) {
                throw new InvalidRequestException('PaymentAccountReferenceNumber should have 50 or fewer characters');
            }
        }

        if (strlen($this['PaymentBrand']) && !preg_match('/^.{1,50}$/', $this['PaymentBrand'])) {
            throw new InvalidRequestException('PaymentBrand should have 50 or fewer characters');
        }

        if (strlen($this['ExpirationMonthBegin'])) {
            if (!preg_match('/^\d{2}$/', $this['ExpirationMonthBegin']) || $this['ExpirationMonthBegin'] > 12) {
                throw new InvalidRequestException('ExpirationMonthBegin should be a two-digit month');
            }
        }

        if (strlen($this['ExpirationMonthEnd'])) {
            if (!preg_match('/^\d{2}$/', $this['ExpirationMonthEnd']) || $this['ExpirationMonthEnd'] > 12) {
                throw new InvalidRequestException('ExpirationMonthEnd should be a two-digit month');
            }
        }

        if (strlen($this['ExpirationYearBegin']) && !preg_match('/^\d{2}$/', $this['ExpirationYearBegin'])) {
            throw new InvalidRequestException('ExpirationYearBegin should be a two-digit year');
        }

        if (strlen($this['ExpirationYearEnd']) && !preg_match('/^\d{2}$/', $this['ExpirationYearEnd'])) {
            throw new InvalidRequestException('ExpirationYearEnd should be a two-digit year');
        }

        if (strlen($this['ExpirationYearBegin']) && strlen($this['ExpirationYearEnd'])) {
            if ($this['ExpirationYearEnd'] < $this['ExpirationYearBegin']) {
                throw new InvalidRequestException('ExpirationYearBegin must be before ExpirationYearEnd');
            }
            if (strlen($this['ExpirationMonthBegin']) && strlen($this['ExpirationMonthEnd'])) {
                if ($this['ExpirationYearBegin'] == $this['ExpirationYearEnd']) {
                    if ($this['ExpirationMonthEnd'] < $this['ExpirationMonthBegin']) {
                        throw new InvalidRequestException('ExpirationMonthBegin must be before ExpirationMonthEnd');
                    }
                }
            }
        }
    }
}
