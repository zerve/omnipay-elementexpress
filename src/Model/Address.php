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

class Address extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [
            'BillingName'      => '',
            'BillingEmail'     => '',
            'BillingPhone'     => '',
            'BillingAddress1'  => '',
            'BillingAddress2'  => '',
            'BillingCity'      => '',
            'BillingState'     => '',
            'BillingZipcode'   => '',
            'ShippingName'     => '',
            'ShippingEmail'    => '',
            'ShippingPhone'    => '',
            'ShippingAddress1' => '',
            'ShippingAddress2' => '',
            'ShippingCity'     => '',
            'ShippingState'    => '',
            'ShippingZipcode'  => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Address'));
        $node->appendChild(new \DOMElement('BillingName', $this['BillingName']));
        $node->appendChild(new \DOMElement('BillingEmail', $this['BillingEmail']));
        $node->appendChild(new \DOMElement('BillingPhone', $this['BillingPhone']));
        $node->appendChild(new \DOMElement('BillingAddress1', $this['BillingAddress1']));
        $node->appendChild(new \DOMElement('BillingAddress2', $this['BillingAddress2']));
        $node->appendChild(new \DOMElement('BillingCity', $this['BillingCity']));
        $node->appendChild(new \DOMElement('BillingState', $this['BillingState']));
        $node->appendChild(new \DOMElement('BillingZipcode', $this['BillingZipcode']));
        $node->appendChild(new \DOMElement('ShippingName', $this['ShippingName']));
        $node->appendChild(new \DOMElement('ShippingEmail', $this['ShippingEmail']));
        $node->appendChild(new \DOMElement('ShippingPhone', $this['ShippingPhone']));
        $node->appendChild(new \DOMElement('ShippingAddress1', $this['ShippingAddress1']));
        $node->appendChild(new \DOMElement('ShippingAddress2', $this['ShippingAddress2']));
        $node->appendChild(new \DOMElement('ShippingCity', $this['ShippingCity']));
        $node->appendChild(new \DOMElement('ShippingState', $this['ShippingState']));
        $node->appendChild(new \DOMElement('ShippingZipcode', $this['ShippingZipcode']));
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
        if (strlen($this['BillingName']) && !preg_match('/^.{1,100}$/', $this['BillingName'])) {
            throw new InvalidRequestException('BillingName should have 100 or fewer characters');
        }

        if (strlen($this['BillingEmail'])) {
            if (!preg_match('/^.{1,80}$/', $this['BillingEmail'])) {
                throw new InvalidRequestException('BillingEmail should have 80 or fewer characters');
            }
            if (!filter_var($this['BillingEmail'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidRequestException('BillingEmail is invalid');
            }
        }

        if (strlen($this['BillingPhone']) && !preg_match('/^.{1,20}$/', $this['BillingPhone'])) {
            throw new InvalidRequestException('BillingPhone should have 20 or fewer characters');
        }

        if (strlen($this['BillingAddress1']) && !preg_match('/^.{1,50}$/', $this['BillingAddress1'])) {
            throw new InvalidRequestException('BillingAddress1 should have 50 or fewer characters');
        }

        if (strlen($this['BillingAddress2']) && !preg_match('/^.{1,50}$/', $this['BillingAddress2'])) {
            throw new InvalidRequestException('BillingAddress2 should have 50 or fewer characters');
        }

        if (strlen($this['BillingCity']) && !preg_match('/^.{1,40}$/', $this['BillingCity'])) {
            throw new InvalidRequestException('BillingCity should have 40 or fewer characters');
        }

        if (strlen($this['BillingState']) && !preg_match('/^.{1,30}$/', $this['BillingState'])) {
            throw new InvalidRequestException('BillingState should have 30 or fewer characters');
        }

        if (strlen($this['BillingZipcode']) && !preg_match('/^.{1,20}$/', $this['BillingZipcode'])) {
            throw new InvalidRequestException('BillingZipcode should have 20 or fewer characters');
        }

        if (strlen($this['ShippingName']) && !preg_match('/^.{1,100}$/', $this['ShippingName'])) {
            throw new InvalidRequestException('ShippingName should have 100 or fewer characters');
        }

        if (strlen($this['ShippingEmail'])) {
            if (!preg_match('/^.{1,80}$/', $this['ShippingEmail'])) {
                throw new InvalidRequestException('ShippingEmail should have 80 or fewer characters');
            }
            if (!filter_var($this['ShippingEmail'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidRequestException('ShippingEmail is invalid');
            }
        }

        if (strlen($this['ShippingPhone']) && !preg_match('/^.{1,20}$/', $this['ShippingPhone'])) {
            throw new InvalidRequestException('ShippingPhone should have 20 or fewer characters');
        }

        if (strlen($this['ShippingAddress1']) && !preg_match('/^.{1,50}$/', $this['ShippingAddress1'])) {
            throw new InvalidRequestException('ShippingAddress1 should have 50 or fewer characters');
        }

        if (strlen($this['ShippingAddress2']) && !preg_match('/^.{1,50}$/', $this['ShippingAddress2'])) {
            throw new InvalidRequestException('ShippingAddress2 should have 50 or fewer characters');
        }

        if (strlen($this['ShippingCity']) && !preg_match('/^.{1,40}$/', $this['ShippingCity'])) {
            throw new InvalidRequestException('ShippingCity should have 40 or fewer characters');
        }

        if (strlen($this['ShippingState']) && !preg_match('/^.{1,30}$/', $this['ShippingState'])) {
            throw new InvalidRequestException('ShippingState should have 30 or fewer characters');
        }

        if (strlen($this['ShippingZipcode']) && !preg_match('/^.{1,20}$/', $this['ShippingZipcode'])) {
            throw new InvalidRequestException('ShippingZipcode should have 20 or fewer characters');
        }
    }
}
