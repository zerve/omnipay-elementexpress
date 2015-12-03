<?php
namespace Omnipay\ElementExpress;

trait HasCommonAccessorsTrait
{
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getDevelopmentEndpoint()
    {
        return $this->getParameter('developmentEndpoint');
    }

    public function setDevelopmentEndpoint($value)
    {
        return $this->setParameter('developmentEndpoint', $value);
    }

    public function getProductionEndpoint()
    {
        return $this->getParameter('productionEndpoint');
    }

    public function setProductionEndpoint($value)
    {
        return $this->setParameter('productionEndpoint', $value);
    }
}
