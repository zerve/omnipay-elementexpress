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

class Application extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [
            'ApplicationID'      => '',
            'ApplicationName'    => '',
            'ApplicationVersion' => ''
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Application'));
        $node->appendChild(new \DOMElement('ApplicationID', $this['ApplicationID']));
        $node->appendChild(new \DOMElement('ApplicationName', $this['ApplicationName']));
        $node->appendChild(new \DOMElement('ApplicationVersion', $this['ApplicationVersion']));
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
        if (strlen($this['ApplicationID']) && !preg_match('/^.{1,40}$/', $this['ApplicationID'])) {
            throw new InvalidRequestException('ApplicationID should have 40 or fewer characters');
        }

        if (strlen($this['ApplicationName']) && !preg_match('/^.{1,50}$/', $this['ApplicationName'])) {
            throw new InvalidRequestException('ApplicationName should have 50 or fewer characters');
        }

        if (strlen($this['ApplicationVersion'])) {
            if (!preg_match('/^.{1,50}$/', $this['ApplicationVersion'])) {
                throw new InvalidRequestException('ApplicationVersion should have 50 or fewer characters');
            }
            if (!preg_match('/^\d+\.\d+\.\d+$/', $this['ApplicationVersion'])) {
                throw new InvalidRequestException('ApplicationVersion should follow #.#.# format');
            }
        }
    }
}
