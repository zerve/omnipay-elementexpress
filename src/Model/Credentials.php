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

class Credentials extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [
            'AccountID'       => '',
            'AccountToken'    => '',
            'AcceptorID'      => '',
            'NewAccountToken' => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Credentials'));
        $node->appendChild(new \DOMElement('AccountID', $this['AccountID']));
        $node->appendChild(new \DOMElement('AccountToken', $this['AccountToken']));
        $node->appendChild(new \DOMElement('AcceptorID', $this['AcceptorID']));
        $node->appendChild(new \DOMElement('NewAccountToken', $this['NewAccountToken']));
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
        if (strlen($this['AccountID']) && !preg_match('/^.{1,10}$/', $this['AccountID'])) {
            throw new InvalidRequestException('AccountID should have 10 or fewer characters');
        }

        if (strlen($this['AccountToken']) && !preg_match('/^.{1,140}$/', $this['AccountToken'])) {
            throw new InvalidRequestException('AccountToken should have 140 or fewer characters');
        }

        if (strlen($this['AcceptorID']) && !preg_match('/^.{1,50}$/', $this['AcceptorID'])) {
            throw new InvalidRequestException('AcceptorID should have 50 or fewer characters');
        }

        if (strlen($this['NewAccountToken']) && !preg_match('/^.{1,140}$/', $this['NewAccountToken'])) {
            throw new InvalidRequestException('NewAccountToken should have 140 or fewer characters');
        }
    }
}
