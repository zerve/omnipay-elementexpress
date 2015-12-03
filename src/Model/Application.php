<?php
namespace Omnipay\ElementExpress\Model;

class Application extends ModelAbstract implements \ArrayAccess
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
}
