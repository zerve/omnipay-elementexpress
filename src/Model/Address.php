<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\Common\Exception\InvalidRequestException;

class Address extends AbstractModel
{
    public function getDefaultParameters()
    {
        return [

            // Elements corresponding directly with standard Omnipay parameter
            // names use those same names here instead of ElementExpress names.

            'billingName'      => '',
            'billingPhone'     => '',
            'billingAddress1'  => '',
            'billingAddress2'  => '',
            'billingCity'      => '',
            'billingState'     => '',
            'billingPostcode'  => '',
            'shippingName'     => '',
            'shippingPhone'    => '',
            'shippingAddress1' => '',
            'shippingAddress2' => '',
            'shippingCity'     => '',
            'shippingState'    => '',
            'shippingPostcode' => '',

            // Remaining elements correspond to ElementExpress parameters.

            'BillingEmail'     => '',
            'ShippingEmail'    => '',

        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Address'));
        $node->appendChild(new \DOMElement('BillingName', $this['billingName']));
        $node->appendChild(new \DOMElement('BillingEmail', $this['BillingEmail']));
        $node->appendChild(new \DOMElement('BillingPhone', $this['billingPhone']));
        $node->appendChild(new \DOMElement('BillingAddress1', $this['billingAddress1']));
        $node->appendChild(new \DOMElement('BillingAddress2', $this['billingAddress2']));
        $node->appendChild(new \DOMElement('BillingCity', $this['billingCity']));
        $node->appendChild(new \DOMElement('BillingState', $this['billingState']));
        $node->appendChild(new \DOMElement('BillingZipcode', $this['billingPostcode']));
        $node->appendChild(new \DOMElement('ShippingName', $this['shippingName']));
        $node->appendChild(new \DOMElement('ShippingEmail', $this['ShippingEmail']));
        $node->appendChild(new \DOMElement('ShippingPhone', $this['shippingPhone']));
        $node->appendChild(new \DOMElement('ShippingAddress1', $this['shippingAddress1']));
        $node->appendChild(new \DOMElement('ShippingAddress2', $this['shippingAddress2']));
        $node->appendChild(new \DOMElement('ShippingCity', $this['shippingCity']));
        $node->appendChild(new \DOMElement('ShippingState', $this['shippingState']));
        $node->appendChild(new \DOMElement('ShippingZipcode', $this['shippingPostcode']));
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
        if (strlen($this['billingName']) && !preg_match('/^.{1,100}$/', $this['billingName'])) {
            throw new InvalidRequestException('billingName should have 100 or fewer characters');
        }

        if (strlen($this['billingPhone']) && !preg_match('/^.{1,20}$/', $this['billingPhone'])) {
            throw new InvalidRequestException('billingPhone should have 20 or fewer characters');
        }

        if (strlen($this['billingEmail'])) {
            if (!preg_match('/^.{1,80}$/', $this['billingEmail'])) {
                throw new InvalidRequestException('billingEmail should have 80 or fewer characters');
            }
            if (!filter_var($this['billingEmail'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidRequestException('billingEmail is invalid');
            }
        }

        if (strlen($this['billingAddress1']) && !preg_match('/^.{1,50}$/', $this['billingAddress1'])) {
            throw new InvalidRequestException('billingAddress1 should have 50 or fewer characters');
        }

        if (strlen($this['billingAddress2']) && !preg_match('/^.{1,50}$/', $this['billingAddress2'])) {
            throw new InvalidRequestException('billingAddress2 should have 50 or fewer characters');
        }

        if (strlen($this['billingCity']) && !preg_match('/^.{1,40}$/', $this['billingCity'])) {
            throw new InvalidRequestException('billingCity should have 40 or fewer characters');
        }

        if (strlen($this['billingState']) && !preg_match('/^.{1,30}$/', $this['billingState'])) {
            throw new InvalidRequestException('billingState should have 30 or fewer characters');
        }

        if (strlen($this['billingPostcode']) && !preg_match('/^.{1,20}$/', $this['billingPostcode'])) {
            throw new InvalidRequestException('billingPostcode should have 20 or fewer characters');
        }

        if (strlen($this['shippingName']) && !preg_match('/^.{1,100}$/', $this['shippingName'])) {
            throw new InvalidRequestException('shippingName should have 100 or fewer characters');
        }

        if (strlen($this['shippingPhone']) && !preg_match('/^.{1,20}$/', $this['shippingPhone'])) {
            throw new InvalidRequestException('shippingPhone should have 20 or fewer characters');
        }

        if (strlen($this['shippingEmail'])) {
            if (!preg_match('/^.{1,80}$/', $this['shippingEmail'])) {
                throw new InvalidRequestException('shippingEmail should have 80 or fewer characters');
            }
            if (!filter_var($this['shippingEmail'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidRequestException('shippingEmail is invalid');
            }
        }

        if (strlen($this['shippingAddress1']) && !preg_match('/^.{1,50}$/', $this['shippingAddress1'])) {
            throw new InvalidRequestException('shippingAddress1 should have 50 or fewer characters');
        }

        if (strlen($this['shippingAddress2']) && !preg_match('/^.{1,50}$/', $this['shippingAddress2'])) {
            throw new InvalidRequestException('shippingAddress2 should have 50 or fewer characters');
        }

        if (strlen($this['shippingCity']) && !preg_match('/^.{1,40}$/', $this['shippingCity'])) {
            throw new InvalidRequestException('shippingCity should have 40 or fewer characters');
        }

        if (strlen($this['shippingState']) && !preg_match('/^.{1,30}$/', $this['shippingState'])) {
            throw new InvalidRequestException('shippingState should have 30 or fewer characters');
        }

        if (strlen($this['shippingPostcode']) && !preg_match('/^.{1,20}$/', $this['shippingPostcode'])) {
            throw new InvalidRequestException('shippingPostcode should have 20 or fewer characters');
        }

    }
}
