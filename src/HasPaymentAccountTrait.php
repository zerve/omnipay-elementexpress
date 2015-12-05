<?php
namespace Omnipay\ElementExpress;

use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\ElementExpress\Model\PaymentAccount;

trait HasPaymentAccountTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getPaymentAccount()
    {
        $model = new PaymentAccount();
        return $model->initialize($this->getParameters());
    }

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
