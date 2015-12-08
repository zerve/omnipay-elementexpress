<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\MarketCode;

class Transaction extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [

            // Elements corresponding directly with standard Omnipay parameter
            // names use those same names here instead of ElementExpress names.

            'amount'               => '', // ElementExpress "TransactionAmount"
            'transactionReference' => '', // ElementExpress "TransactionID"
            'transactionId'        => '', // ElementExpress "ReferenceNumber"

            // Remaining elements correspond to ElementExpress parameters.

            'MarketCode'           => MarketCode::__DEFAULT(),
            'PartialApprovedFlag'  => '',

        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Transaction'));

        // Append parameters.

        $node->appendChild(new \DOMElement('TransactionAmount', $this['amount']));
        $node->appendChild(new \DOMElement('TransactionID', $this['transactionReference']));
        $node->appendChild(new \DOMElement('ReferenceNumber', $this['transactionId']));
        $node->appendChild(new \DOMElement('MarketCode', $this['MarketCode']->value()));
        $node->appendChild(new \DOMElement('PartialApprovedFlag', $this['PartialApprovedFlag']));
    }
}
