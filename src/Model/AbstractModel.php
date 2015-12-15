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

abstract class AbstractModel implements \ArrayAccess
{
    /**
     * Internal data set.
     *
     * @var array $data
     */
    protected $data = array();

    /**
     * Retrieve default values for internal parameters. Every data point in the
     * model must be represented in the returned array, and all values must be
     * strings (use the empty string instead of null where appropriate).
     */
    abstract public function getDefaultParameters();

    /**
     * Add model data to provided DOM node.
     * @param \DOMNode $parent
     */
    abstract public function appendToDom(\DOMNode $parent);

    /**
     * Initialize from parameter array
     */
    public function initialize(array $parameters)
    {
        foreach ($this->getDefaultParameters() as $key => $value) {
            if (isset($parameters[$key])) {
                $value = $parameters[$key];
            }
            $this[$key] = $value;
        }
        return $this;
    }

    /**
     * Return internal data set
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * Implement \ArrayAccess
     */
    public function offsetSet($offset, $value)
    {
        if (empty($offset) && 0 != $offset) {
            throw new \InvalidArgumentException('Offset cannot be empty');
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Implement \ArrayAccess
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Implement \ArrayAccess
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * Implement \ArrayAccess
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
}
