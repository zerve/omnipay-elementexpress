<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\PaymentAccountType;

class PaymentAccount extends ModelAbstract
{
    public function getDefaultParameters()
    {
        return [
            'PaymentAccountID'              => '',
            'PaymentAccountType'            => '',
            'PaymentAccountReferenceNumber' => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('PaymentAccount'));
        $node->appendChild(new \DOMElement('PaymentAccountID', $this['PaymentAccountID']));
        if (!empty($this['PaymentAccountType'])) {
            $node->appendChild(new \DOMElement('PaymentAccountType', $this['PaymentAccountType']->value()));
        }
        $node->appendChild(new \DOMElement('PaymentAccountReferenceNumber', $this['PaymentAccountReferenceNumber']));
    }
}
