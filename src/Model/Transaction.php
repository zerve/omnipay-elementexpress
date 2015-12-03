<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\MarketCode;

class Transaction extends ModelAbstract implements \ArrayAccess
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

            'MarketCode'           => MarketCode::__DEFAULT()

        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Transaction'));

        // Append parameters that need to be mapped from the Omnipay to the
        // ElementExpress domain.

        $node->appendChild(new \DOMElement('TransactionAmount', $this['amount']));
        $node->appendChild(new \DOMElement('TransactionID', $this['transactionReference']));
        $node->appendChild(new \DOMElement('ReferenceNumber', $this['transactionId']));

        // Append parameters that do not require mapping.

        $node->appendChild(new \DOMElement('MarketCode', $this['MarketCode']->value()));
    }
}
