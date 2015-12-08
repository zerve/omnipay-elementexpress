<?php
namespace Omnipay\ElementExpress\Model;

trait CredentialsTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getCredentialsModel()
    {
        $model = new Credentials();
        return $model->initialize($this->getParameters());
    }

    public function getAccountID()
    {
        return $this->getParameter('AccountID');
    }

    public function setAccountID($value)
    {
        return $this->setParameter('AccountID', $value);
    }

    public function getAccountToken()
    {
        return $this->getParameter('AccountToken');
    }

    public function setAccountToken($value)
    {
        return $this->setParameter('AccountToken', $value);
    }

    public function getAcceptorID()
    {
        return $this->getParameter('AcceptorID');
    }

    public function setAcceptorID($value)
    {
        return $this->setParameter('AcceptorID', $value);
    }

    public function getNewAccountToken()
    {
        return $this->getParameter('NewAccountToken');
    }

    public function setNewAccountToken($value)
    {
        return $this->setParameter('NewAccountToken', $value);
    }
}