<?php
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
