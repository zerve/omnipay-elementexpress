<?php
namespace Omnipay\ElementExpress;

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

    public function getTransactionAmount()
    {
        return $this->getParameter('TransactionAmount');
    }

    public function setTransactionAmount($value)
    {
        return $this->setParameter('TransactionAmount', $value);
    }

    public function getTransactionID()
    {
        return $this->getParameter('TransactionID');
    }

    public function setTransactionID($value)
    {
        return $this->setParameter('TransactionID', $value);
    }

    public function getMarketCode()
    {
        return $this->getParameter('MarketCode');
    }

    public function setMarketCode(MarketCode $value)
    {
        return $this->setParameter('MarketCode', $value);
    }
}
