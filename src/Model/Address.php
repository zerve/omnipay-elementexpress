<?php
namespace Omnipay\ElementExpress\Model;

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
}
