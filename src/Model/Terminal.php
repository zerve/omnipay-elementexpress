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
            'TerminalType'            => TerminalType::UNKNOWN(),
            'CardPresentCode'         => CardPresentCode::__DEFAULT(),
            'CardholderPresentCode'   => CardholderPresentCode::__DEFAULT(),
            'CardInputCode'           => CardInputCode::__DEFAULT(),
            'CVVPresenceCode'         => CVVPresenceCode::__DEFAULT(),
            'TerminalCapabilityCode'  => TerminalCapabilityCode::__DEFAULT(),
            'TerminalEnvironmentCode' => TerminalEnvironmentCode::__DEFAULT(),
            'MotoECICode'             => MotoECICode::__DEFAULT(),
            'TerminalSerialNumber'    => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Terminal'));
        $node->appendChild(new \DOMElement('TerminalID', $this['TerminalID']));
        $node->appendChild(new \DOMElement('TerminalType', $this['TerminalType']->value()));
        $node->appendChild(new \DOMElement('CardPresentCode', $this['CardPresentCode']->value()));
        $node->appendChild(new \DOMElement('CardholderPresentCode', $this['CardholderPresentCode']->value()));
        $node->appendChild(new \DOMElement('CardInputCode', $this['CardInputCode']->value()));
        $node->appendChild(new \DOMElement('CVVPresenceCode', $this['CVVPresenceCode']->value()));
        $node->appendChild(new \DOMElement('TerminalCapabilityCode', $this['TerminalCapabilityCode']->value()));
        $node->appendChild(new \DOMElement('TerminalEnvironmentCode', $this['TerminalEnvironmentCode']->value()));
        $node->appendChild(new \DOMElement('MotoECICode', $this['MotoECICode']->value()));
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

        if (isset($this['TerminalType']) && !$this['TerminalType'] instanceof TerminalType) {
            throw new InvalidRequestException('Invalid value for TerminalType');
        }

        if (isset($this['CardPresentCode']) && !$this['CardPresentCode'] instanceof CardPresentCode) {
            throw new InvalidRequestException('Invalid value for CardPresentCode');
        }

        if (isset($this['CardholderPresentCode'])) {
            if (!$this['CardholderPresentCode'] instanceof CardholderPresentCode) {
                throw new InvalidRequestException('Invalid value for CardholderPresentCode');
            }
        }

        if (isset($this['CardInputCode']) && !$this['CardInputCode'] instanceof CardInputCode) {
            throw new InvalidRequestException('Invalid value for CardInputCode');
        }

        if (isset($this['CVVPresenceCode']) && !$this['CVVPresenceCode'] instanceof CVVPresenceCode) {
            throw new InvalidRequestException('Invalid value for CVVPresenceCode');
        }

        if (isset($this['TerminalCapabilityCode'])) {
            if (!$this['TerminalCapabilityCode'] instanceof TerminalCapabilityCode) {
                throw new InvalidRequestException('Invalid value for TerminalCapabilityCode');
            }
        }

        if (isset($this['TerminalEnvironmentCode'])) {
            if (!$this['TerminalEnvironmentCode'] instanceof TerminalEnvironmentCode) {
                throw new InvalidRequestException('Invalid value for TerminalEnvironmentCode');
            }
        }

        if (isset($this['MotoECICode']) && !$this['MotoECICode'] instanceof MotoECICode) {
            throw new InvalidRequestException('Invalid value for MotoECICode');
        }

        if (strlen($this['TerminalSerialNumber']) && !preg_match('/^.{1,40}$/', $this['TerminalSerialNumber'])) {
            throw new InvalidRequestException('TerminalSerialNumber should have 40 or fewer characters');
        }
    }
}
