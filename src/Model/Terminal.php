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
use Omnipay\ElementExpress\Enumeration\CardPresentCode;
use Omnipay\ElementExpress\Enumeration\CardholderPresentCode;
use Omnipay\ElementExpress\Enumeration\CardInputCode;
use Omnipay\ElementExpress\Enumeration\CVVPresenceCode;
use Omnipay\ElementExpress\Enumeration\TerminalCapabilityCode;
use Omnipay\ElementExpress\Enumeration\TerminalEnvironmentCode;
use Omnipay\ElementExpress\Enumeration\TerminalType;
use Omnipay\ElementExpress\Enumeration\MotoECICode;

class Terminal extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [
            'TerminalID'              => '',
            'TerminalType'            => TerminalType::UNKNOWN,
            'TerminalCapabilityCode'  => TerminalCapabilityCode::__DEFAULT,
            'TerminalEnvironmentCode' => TerminalEnvironmentCode::__DEFAULT,
            'CardPresentCode'         => CardPresentCode::__DEFAULT,
            'CVVPresenceCode'         => CVVPresenceCode::__DEFAULT,
            'CardInputCode'           => CardInputCode::__DEFAULT,
            'CardholderPresentCode'   => CardholderPresentCode::__DEFAULT,
            'MotoECICode'             => MotoECICode::__DEFAULT,
            'TerminalSerialNumber'    => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Terminal'));
        $node->appendChild(new \DOMElement('TerminalID', $this['TerminalID']));
        $node->appendChild(new \DOMElement('TerminalType', $this['TerminalType']));
        $node->appendChild(new \DOMElement('TerminalCapabilityCode', $this['TerminalCapabilityCode']));
        $node->appendChild(new \DOMElement('TerminalEnvironmentCode', $this['TerminalEnvironmentCode']));
        $node->appendChild(new \DOMElement('CardPresentCode', $this['CardPresentCode']));
        $node->appendChild(new \DOMElement('CVVPresenceCode', $this['CVVPresenceCode']));
        $node->appendChild(new \DOMElement('CardInputCode', $this['CardInputCode']));
        $node->appendChild(new \DOMElement('CardholderPresentCode', $this['CardholderPresentCode']));
        $node->appendChild(new \DOMElement('MotoECICode', $this['MotoECICode']));
        $node->appendChild(new \DOMElement('TerminalSerialNumber', $this['TerminalSerialNumber']));
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
        if (strlen($this['TerminalID']) && !preg_match('/^.{1,40}$/', $this['TerminalID'])) {
            throw new InvalidRequestException('TerminalID should have 40 or fewer characters');
        }

        if (isset($this['TerminalType'])) {
            try {
                TerminalType::memberByValue($this['TerminalType']);
            } catch(\Exception $e) {
                throw new InvalidRequestException('Invalid value for TerminalType');
            }
        }

        if (isset($this['TerminalCapabilityCode'])) {
            try {
                TerminalCapabilityCode::memberByValue($this['TerminalCapabilityCode']);
            } catch(\Exception $e) {
                throw new InvalidRequestException('Invalid value for TerminalCapabilityCode');
            }
        }

        if (isset($this['TerminalEnvironmentCode'])) {
            try {
                TerminalEnvironmentCode::memberByValue($this['TerminalEnvironmentCode']);
            } catch(\Exception $e) {
                throw new InvalidRequestException('Invalid value for TerminalEnvironmentCode');
            }
        }

        if (isset($this['CardPresentCode'])) {
            try {
                CardPresentCode::memberByValue($this['CardPresentCode']);
            } catch(\Exception $e) {
                throw new InvalidRequestException('Invalid value for CardPresentCode');
            }
        }

        if (isset($this['CVVPresenceCode'])) {
            try {
                CVVPresenceCode::memberByValue($this['CVVPresenceCode']);
            } catch(\Exception $e) {
                throw new InvalidRequestException('Invalid value for CVVPresenceCode');
            }
        }

        if (isset($this['CardInputCode'])) {
            try {
                CardInputCode::memberByValue($this['CardInputCode']);
            } catch(\Exception $e) {
                throw new InvalidRequestException('Invalid value for CardInputCode');
            }
        }

        if (isset($this['CardholderPresentCode'])) {
            try {
                CardholderPresentCode::memberByValue($this['CardholderPresentCode']);
            } catch(\Exception $e) {
                throw new InvalidRequestException('Invalid value for CardholderPresentCode');
            }
        }

        if (isset($this['MotoECICode'])) {
            try {
                MotoECICode::memberByValue($this['MotoECICode']);
            } catch(\Exception $e) {
                throw new InvalidRequestException('Invalid value for MotoECICode');
            }
        }

        if (strlen($this['TerminalSerialNumber']) && !preg_match('/^.{1,40}$/', $this['TerminalSerialNumber'])) {
            throw new InvalidRequestException('TerminalSerialNumber should have 40 or fewer characters');
        }
    }
}
