<?php

namespace Omnipay\ElementExpress;

use Omnipay\ElementExpress\Enumeration\CardholderPresentCode;
use Omnipay\ElementExpress\Enumeration\CardInputCode;
use Omnipay\ElementExpress\Enumeration\CardPresentCode;
use Omnipay\ElementExpress\Enumeration\CVVPresenceCode;
use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\ElementExpress\Enumeration\MotoECICode;
use Omnipay\ElementExpress\Enumeration\TerminalCapabilityCode;
use Omnipay\ElementExpress\Enumeration\TerminalEnvironmentCode;

// TODO: some of these are request-specific, and should not be shared with
//       gateway.

trait HasCommonAccessorsTrait
{
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getAccountID()
    {
        return $this->getParameter('accountID');
    }

    public function setAccountID($value)
    {
        return $this->setParameter('accountID', $value);
    }

    public function getAccountToken()
    {
        return $this->getParameter('accountToken');
    }

    public function setAccountToken($value)
    {
        return $this->setParameter('accountToken', $value);
    }

    public function getAcceptorID()
    {
        return $this->getParameter('acceptorID');
    }

    public function setAcceptorID($value)
    {
        return $this->setParameter('acceptorID', $value);
    }

    public function getApplicationID()
    {
        return $this->getParameter('applicationID');
    }

    public function setApplicationID($value)
    {
        return $this->setParameter('applicationID', $value);
    }

    public function getApplicationName()
    {
        return $this->getParameter('applicationName');
    }

    public function setApplicationName($value)
    {
        return $this->setParameter('applicationName', $value);
    }

    public function getApplicationVersion()
    {
        return $this->getParameter('applicationVersion');
    }

    public function setApplicationVersion($value)
    {
        return $this->setParameter('applicationVersion', $value);
    }

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
