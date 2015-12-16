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
use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\ElementExpress\Enumeration\ReversalType;

class Transaction extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [
            'TransactionID'             => '',
            'TransactionAmount'         => '',
            'ReferenceNumber'           => '',
            'ReversalType'              => '',
            'MarketCode'                => MarketCode::__DEFAULT(),
            'DuplicateCheckDisableFlag' => '',
            'DuplicateOverrideFlag'     => '',
            'TicketNumber'              => '',
            'PartialApprovedFlag'       => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Transaction'));

        // Append parameters.

        $node->appendChild(new \DOMElement('TransactionID', $this['TransactionID']));
        $node->appendChild(new \DOMElement('TransactionAmount', $this['TransactionAmount']));
        $node->appendChild(new \DOMElement('ReferenceNumber', $this['ReferenceNumber']));
        if (!empty($this['ReversalType'])) {
            $node->appendChild(new \DOMElement('ReversalType', $this['ReversalType']->value()));
        }
        $node->appendChild(new \DOMElement('MarketCode', $this['MarketCode']->value()));
        $node->appendChild(new \DOMElement('DuplicateCheckDisableFlag', $this['DuplicateCheckDisableFlag']));
        $node->appendChild(new \DOMElement('DuplicateOverrideFlag', $this['DuplicateOverrideFlag']));
        $node->appendChild(new \DOMElement('TicketNumber', $this['TicketNumber']));
        $node->appendChild(new \DOMElement('PartialApprovedFlag', $this['PartialApprovedFlag']));
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
        if (strlen($this['TransactionID']) && !preg_match('/^.{1,10}$/', $this['TransactionID'])) {
            throw new InvalidRequestException('TransactionID should have 10 or fewer characters');
        }

        if (strlen($this['TransactionAmount'])) {
            if (!is_numeric($this['TransactionAmount'])) {
                throw new InvalidRequestException('TransactionAmount should be numeric');
            }
            if (0 >= $this['TransactionAmount']) {
                throw new InvalidRequestException('TransactionAmount should be non-zero and positive');
            }
            if (!preg_match('/^.{1,10}$/', $this['TransactionAmount'])) {
                throw new InvalidRequestException('TransactionAmount should have 10 or fewer characters');
            }
        }

        if (strlen($this['ReferenceNumber']) && !preg_match('/^.{1,50}$/', $this['ReferenceNumber'])) {
            throw new InvalidRequestException('ReferenceNumber should have 50 or fewer characters');
        }

        if (isset($this['ReversalType']) && !$this['ReversalType'] instanceof ReversalType) {
            throw new InvalidRequestException('Invalid value for ReversalType');
        }

        if (isset($this['MarketCode']) && !$this['MarketCode'] instanceof MarketCode) {
            throw new InvalidRequestException('Invalid value for MarketCode');
        }

        if (strlen($this['DuplicateCheckDisableFlag'])) {
            if (!preg_match('/^(0|1)$/', $this['DuplicateCheckDisableFlag'])) {
                throw new InvalidRequestException('DuplicateCheckDisableFlag should be "0" or "1"');
            }
        }

        if (strlen($this['DuplicateOverrideFlag']) && !preg_match('/^(0|1)$/', $this['DuplicateOverrideFlag'])) {
            throw new InvalidRequestException('DuplicateOverrideFlag should be "0" or "1"');
        }

        if (strlen($this['TicketNumber']) && !preg_match('/^.{1,50}$/', $this['TicketNumber'])) {
            throw new InvalidRequestException('TicketNumber should have 50 or fewer characters');
        }

        if (strlen($this['PartialApprovedFlag']) && !preg_match('/^(0|1)$/', $this['PartialApprovedFlag'])) {
            throw new InvalidRequestException('PartialApprovedFlag should be "0" or "1"');
        }
    }
}
