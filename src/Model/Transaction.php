<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\MarketCode;

class Transaction extends ModelAbstract implements \ArrayAccess
{
    public function getDefaultParameters()
    {
        return [
            'TransactionAmount' => '',
            'TransactionID'     => '',
            'MarketCode'        => MarketCode::__DEFAULT()
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Transaction'));
        $node->appendChild(new \DOMElement('TransactionAmount', $this['TransactionAmount']));
        $node->appendChild(new \DOMElement('TransactionID', $this['TransactionID']));
        $node->appendChild(new \DOMElement('MarketCode', $this['MarketCode']->value()));
    }
}
