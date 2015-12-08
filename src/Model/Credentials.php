<?php
namespace Omnipay\ElementExpress\Model;

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
}
