<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\ElementExpress\Enumeration\ReversalType;

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

            'ReversalType'         => '',
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
        if (!empty($this['ReversalType'])) {
            $node->appendChild(new \DOMElement('ReversalType', $this['ReversalType']->value()));
        }
        $node->appendChild(new \DOMElement('MarketCode', $this['MarketCode']->value()));
        $node->appendChild(new \DOMElement('PartialApprovedFlag', $this['PartialApprovedFlag']));
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
        if (strlen($this['amount'])) {
            if (!is_numeric($this['amount'])) {
                throw new InvalidRequestException('amount should be numeric');
            }
            if (0 >= $this['amount']) {
                throw new InvalidRequestException('amount should be non-zero and positive');
            }
            if (!preg_match('/^.{1,10}$/', $this['amount'])) {
                throw new InvalidRequestException('amount should have 10 or fewer characters');
            }
        }

        if (strlen($this['transactionReference']) && !preg_match('/^.{1,10}$/', $this['transactionReference'])) {
            throw new InvalidRequestException('transactionReference should have 10 or fewer characters');
        }

        if (strlen($this['transactionId']) && !preg_match('/^.{1,50}$/', $this['transactionId'])) {
            throw new InvalidRequestException('transactionId should have 50 or fewer characters');
        }

        if (isset($this['ReversalType']) && !$this['ReversalType'] instanceof ReversalType) {
            throw new InvalidRequestException('Invalid value for ReversalType');
        }

        if (isset($this['MarketCode']) && !$this['MarketCode'] instanceof MarketCode) {
            throw new InvalidRequestException('Invalid value for MarketCode');
        }

        if (strlen($this['PartialApprovedFlag']) && !preg_match('/^(0|1)$/', $this['PartialApprovedFlag'])) {
            throw new InvalidRequestException('PartialApprovedFlag should be "0" or "1"');
        }
    }
}
