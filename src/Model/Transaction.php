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

            // Elements corresponding directly with standard Omnipay parameter
            // names use those same names here instead of ElementExpress names.

            'amount'                    => '', // ElementExpress "TransactionAmount"
            'transactionReference'      => '', // ElementExpress "TransactionID"
            'transactionId'             => '', // ElementExpress "ReferenceNumber"

            // Remaining elements correspond to ElementExpress parameters.

            'ReversalType'              => '',
            'MarketCode'                => MarketCode::__DEFAULT(),
            'PartialApprovedFlag'       => '',
            'DuplicateOverrideFlag'     => '',
            'DuplicateCheckDisableFlag' => '',
            'TicketNumber'              => '',

        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Transaction'));

        // Append parameters.

        $node->appendChild(new \DOMElement('TransactionAmount', $this['amount']));
        $node->appendChild(new \DOMElement('TransactionID', $this['transactionReference']));
        $node->appendChild(new \DOMElement('ReferenceNumber', $this['transactionId']));
        if (!empty($this['ReversalType'])) {
            $node->appendChild(new \DOMElement('ReversalType', $this['ReversalType']->value()));
        }
        $node->appendChild(new \DOMElement('MarketCode', $this['MarketCode']->value()));
        $node->appendChild(new \DOMElement('PartialApprovedFlag', $this['PartialApprovedFlag']));
        $node->appendChild(new \DOMElement('DuplicateOverrideFlag', $this['DuplicateOverrideFlag']));
        $node->appendChild(new \DOMElement('DuplicateCheckDisableFlag', $this['DuplicateCheckDisableFlag']));
        $node->appendChild(new \DOMElement('TicketNumber', $this['TicketNumber']));
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
        if (strlen($this['amount'])) {
            if (!is_numeric($this['amount'])) {
                throw new InvalidRequestException('amount should be numeric');
            }
            if (0 >= $this['amount']) {
                throw new InvalidRequestException('amount should be non-zero and positive');
            }
            if (!preg_match('/^.{1,10}$/', $this['amount'])) {
                throw new InvalidRequestException('amount should have 10 or fewer characters');
            }
        }

        if (strlen($this['transactionReference']) && !preg_match('/^.{1,10}$/', $this['transactionReference'])) {
            throw new InvalidRequestException('transactionReference should have 10 or fewer characters');
        }

        if (strlen($this['transactionId']) && !preg_match('/^.{1,50}$/', $this['transactionId'])) {
            throw new InvalidRequestException('transactionId should have 50 or fewer characters');
        }

        if (isset($this['ReversalType']) && !$this['ReversalType'] instanceof ReversalType) {
            throw new InvalidRequestException('Invalid value for ReversalType');
        }

        if (isset($this['MarketCode']) && !$this['MarketCode'] instanceof MarketCode) {
            throw new InvalidRequestException('Invalid value for MarketCode');
        }

        if (strlen($this['PartialApprovedFlag']) && !preg_match('/^(0|1)$/', $this['PartialApprovedFlag'])) {
            throw new InvalidRequestException('PartialApprovedFlag should be "0" or "1"');
        }

        if (strlen($this['DuplicateOverrideFlag']) && !preg_match('/^(0|1)$/', $this['DuplicateOverrideFlag'])) {
            throw new InvalidRequestException('DuplicateOverrideFlag should be "0" or "1"');
        }

        if (strlen($this['DuplicateCheckDisableFlag'])) {
            if (!preg_match('/^(0|1)$/', $this['DuplicateCheckDisableFlag'])) {
                throw new InvalidRequestException('DuplicateCheckDisableFlag should be "0" or "1"');
            }
        }

        if (strlen($this['TicketNumber']) && !preg_match('/^.{1,50}$/', $this['TicketNumber'])) {
            throw new InvalidRequestException('TicketNumber should have 50 or fewer characters');
        }
    }
}
