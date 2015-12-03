<?php
namespace Omnipay\ElementExpress;

use Omnipay\ElementExpress\Model\Application;

trait HasApplicationTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getApplication()
    {
        $model = new Application();
        return $model->initialize($this->getParameters());
    }

    public function getApplicationID()
    {
        return $this->getParameter('ApplicationID');
    }

    public function setApplicationID($value)
    {
        return $this->setParameter('ApplicationID', $value);
    }

    public function getApplicationName()
    {
        return $this->getParameter('ApplicationName');
    }

    public function setApplicationName($value)
    {
        return $this->setParameter('ApplicationName', $value);
    }

    public function getApplicationVersion()
    {
        return $this->getParameter('ApplicationVersion');
    }

    public function setApplicationVersion($value)
    {
        return $this->setParameter('ApplicationVersion', $value);
    }
}
