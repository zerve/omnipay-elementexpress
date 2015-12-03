<?php
namespace Omnipay\ElementExpress\Model;

abstract class ModelAbstract implements \ArrayAccess
{
    use HasDataTrait;

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
}
