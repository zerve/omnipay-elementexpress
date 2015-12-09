<?php
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
            throw new InvalidRequestException('AccountID should 10 or fewer characters');
        }

        if (strlen($this['AccountToken']) && !preg_match('/^.{1,140}$/', $this['AccountToken'])) {
            throw new InvalidRequestException('AccountToken should 140 or fewer characters');
        }

        if (strlen($this['AcceptorID']) && !preg_match('/^.{1,50}$/', $this['AcceptorID'])) {
            throw new InvalidRequestException('AcceptorID should 50 or fewer characters');
        }

        if (strlen($this['NewAccountToken']) && !preg_match('/^.{1,140}$/', $this['NewAccountToken'])) {
            throw new InvalidRequestException('NewAccountToken should 140 or fewer characters');
        }
    }
}
