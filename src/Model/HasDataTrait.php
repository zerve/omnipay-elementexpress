<?php
namespace Omnipay\ElementExpress\Model;

/**
 * Trait providing a protected data array with access methods implementing the
 * \ArrayAccess interface. Classes using this trait can declare implementation
 * of \ArrayAccess, for example:
 *
 *   class MyClass implements \ArrayAccess
 *   {
 *       use HasDataTrait;
 *       ...
 *   }
 *
 *   $myInstance = new MyClass();
 *   $myInstance['id'] = 2;
 *   // etc.
 *
 * In addition to the \ArrayAccess implementation, this trait also provides a
 * toArray() method which returns the internal data array.
 */
trait HasDataTrait
{
    /**
     * Internal data set.
     *
     * @var array $data
     */
    protected $data = array();

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
