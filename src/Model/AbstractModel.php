<?php
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
