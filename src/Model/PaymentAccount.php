<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\PaymentAccountType;

class PaymentAccount extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [

            // Elements corresponding directly with standard Omnipay parameter
            // names use those same names here instead of ElementExpress names.

            'cardReference'                 => '', // ElementExpress "PaymentAccountID"

            // Remaining elements correspond to ElementExpress parameters.

            'PaymentAccountType'            => '',
            'PaymentAccountReferenceNumber' => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('PaymentAccount'));
        $node->appendChild(new \DOMElement('PaymentAccountID', $this['cardReference']));
        if (!empty($this['PaymentAccountType'])) {
            $node->appendChild(new \DOMElement('PaymentAccountType', $this['PaymentAccountType']->value()));
        }
        $node->appendChild(new \DOMElement('PaymentAccountReferenceNumber', $this['PaymentAccountReferenceNumber']));
    }
}
