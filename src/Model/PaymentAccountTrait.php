<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\PaymentAccountType;

trait PaymentAccountTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getPaymentAccountModel()
    {
        $model = new PaymentAccount();
        return $model->initialize($this->getParameters());
    }

    // The following mutators/accessors correspond to parameters that have
    // Omnipay equivalents. These are named with the Omnipay convention and
    // mapped to the ElementExpress domain in the model.

    public function getCardReference()
    {
        return $this->getParameter('cardReference');
    }

    public function setCardReference($value)
    {
        return $this->setParameter('cardReference', $value);
    }

    // The following mutators/accessors correspond to parameters that are
    // unique to the ElementExpress domain.

    public function getPaymentAccountType()
    {
        return $this->getParameter('PaymentAccountType');
    }

    public function setPaymentAccountType(PaymentAccountType $value)
    {
        return $this->setParameter('PaymentAccountType', $value);
    }

    public function getPaymentAccountReferenceNumber()
    {
        return $this->getParameter('PaymentAccountReferenceNumber');
    }

    public function setPaymentAccountReferenceNumber($value)
    {
        return $this->setParameter('PaymentAccountReferenceNumber', $value);
    }
}
