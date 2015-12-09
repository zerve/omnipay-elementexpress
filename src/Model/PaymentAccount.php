<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\Common\Exception\InvalidRequestException;
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


    /**
     * Model validation ensures that any data that is present in the model is
     * formatted correctly. No business logic validation is performed at this
     * level.
     *
     * @throws InvalidRequestException if validation fails.
     */
    public function validate()
    {
        if (strlen($this['cardReference']) && !preg_match('/^.{1,50}$/', $this['cardReference'])) {
            throw new InvalidRequestException('cardReference should 50 or fewer characters');
        }

        if (isset($this['PaymentAccountType']) && !$this['PaymentAccountType'] instanceof PaymentAccountType) {
            throw new InvalidRequestException('Invalid value for PaymentAccountType');
        }

        if (strlen($this['PaymentAccountReferenceNumber'])) {
            if (!preg_match('/^.{1,50}$/', $this['PaymentAccountReferenceNumber'])) {
                throw new InvalidRequestException('PaymentAccountReferenceNumber should 50 or fewer characters');
            }
        }
    }
}
