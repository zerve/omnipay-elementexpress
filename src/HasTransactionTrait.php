<?php
namespace Omnipay\ElementExpress;

use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\ElementExpress\Model\Transaction;

trait HasTransactionTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getTransaction()
    {
        $model = new Transaction();
        return $model->initialize($this->getParameters());
    }

    // The following mutators/accessors correspond to parameters that have
    // Omnipay equivalents. These are named with the Omnipay convention and
    // mapped to the ElementExpress domain in the model.

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getTransactionId()
    {
        return $this->getParameter('transactionId');
    }

    public function setTransactionId($value)
    {
        return $this->setParameter('transactionId', $value);
    }

    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
    }

    public function setTransactionReference($value)
    {
        return $this->setParameter('transactionReference', $value);
    }

    // The following mutators/accessors correspond to parameters that are
    // unique to the ElementExpress domain.

    public function getMarketCode()
    {
        return $this->getParameter('MarketCode');
    }

    public function setMarketCode(MarketCode $value)
    {
        return $this->setParameter('MarketCode', $value);
    }
}
