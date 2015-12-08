<?php
namespace Omnipay\ElementExpress\Model;

trait AddressTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    /**
     * Unlike other getModel() methods, the Address object is initialized using
     * data from the Omnipay 'card' parameter which is an object in the Omnipay
     * domain.
     */
    public function getAddressModel()
    {
        $model = new Address();
        $parameters = $this->getParameters();
        if ($card = $this->getParameter('card')) {
            $parameters = array_merge($parameters, $card->getParameters());
        }
        return $model->initialize($parameters);
    }

    // The following mutators/accessors correspond to parameters that have
    // Omnipay equivalents. These are named with the Omnipay convention and
    // mapped to the ElementExpress domain in the model.

    public function getBillingName()
    {
        return $this->getParameter('billingName');
    }

    public function setBillingName($value)
    {
        return $this->setParameter('billingName', $value);
    }

    public function getBillingPhone()
    {
        return $this->getParameter('billingPhone');
    }

    public function setBillingPhone($value)
    {
        return $this->setParameter('billingPhone', $value);
    }

    public function getBillingAddress1()
    {
        return $this->getParameter('billingAddress1');
    }

    public function setBillingAddress1($value)
    {
        return $this->setParameter('billingAddress1', $value);
    }

    public function getBillingAddress2()
    {
        return $this->getParameter('billingAddress2');
    }

    public function setBillingAddress2($value)
    {
        return $this->setParameter('billingAddress2', $value);
    }

    public function getBillingCity()
    {
        return $this->getParameter('billingCity');
    }

    public function setBillingCity($value)
    {
        return $this->setParameter('billingCity', $value);
    }

    public function getBillingState()
    {
        return $this->getParameter('billingState');
    }

    public function setBillingState($value)
    {
        return $this->setParameter('billingState', $value);
    }

    public function getBillingPostcode()
    {
        return $this->getParameter('billingPostcode');
    }

    public function setBillingPostcode($value)
    {
        return $this->setParameter('billingPostcode', $value);
    }

    public function getShippingName()
    {
        return $this->getParameter('shippingName');
    }

    public function setShippingName($value)
    {
        return $this->setParameter('shippingName', $value);
    }

    public function getShippingPhone()
    {
        return $this->getParameter('shippingPhone');
    }

    public function setShippingPhone($value)
    {
        return $this->setParameter('shippingPhone', $value);
    }

    public function getShippingAddress1()
    {
        return $this->getParameter('shippingAddress1');
    }

    public function setShippingAddress1($value)
    {
        return $this->setParameter('shippingAddress1', $value);
    }

    public function getShippingAddress2()
    {
        return $this->getParameter('shippingAddress2');
    }

    public function setShippingAddress2($value)
    {
        return $this->setParameter('shippingAddress2', $value);
    }

    public function getShippingCity()
    {
        return $this->getParameter('shippingCity');
    }

    public function setShippingCity($value)
    {
        return $this->setParameter('shippingCity', $value);
    }

    public function getShippingState()
    {
        return $this->getParameter('shippingState');
    }

    public function setShippingState($value)
    {
        return $this->setParameter('shippingState', $value);
    }

    public function getShippingPostcode()
    {
        return $this->getParameter('shippingPostcode');
    }

    public function setShippingPostcode($value)
    {
        return $this->setParameter('shippingPostcode', $value);
    }

    // The following mutators/accessors correspond to parameters that are
    // unique to the ElementExpress domain.

    public function getBillingEmail()
    {
        return $this->getParameter('BillingEmail');
    }

    public function setBillingEmail($value)
    {
        return $this->setParameter('BillingEmail', $value);
    }

    public function getShippingEmail()
    {
        return $this->getParameter('ShippingEmail');
    }

    public function setShippingEmail($value)
    {
        return $this->setParameter('ShippingEmail', $value);
    }
}
