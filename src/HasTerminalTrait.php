<?php
namespace Omnipay\ElementExpress;

use Omnipay\ElementExpress\Enumeration\CardPresentCode;
use Omnipay\ElementExpress\Enumeration\CardholderPresentCode;
use Omnipay\ElementExpress\Enumeration\CardInputCode;
use Omnipay\ElementExpress\Enumeration\CVVPresenceCode;
use Omnipay\ElementExpress\Enumeration\TerminalCapabilityCode;
use Omnipay\ElementExpress\Enumeration\TerminalEnvironmentCode;
use Omnipay\ElementExpress\Enumeration\MotoECICode;
use Omnipay\ElementExpress\Model\Terminal;

trait HasTerminalTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getTerminal()
    {
        $model = new Terminal();
        return $model->initialize($this->getParameters());
    }

    public function getTerminalID()
    {
        return $this->getParameter('TerminalID');
    }

    public function setTerminalID($value)
    {
        return $this->setParameter('TerminalID', $value);
    }

    public function getCardPresentCode()
    {
        return $this->getParameter('CardPresentCode');
    }

    public function setCardPresentCode(CardPresentCode $value)
    {
        return $this->setParameter('CardPresentCode', $value);
    }

    public function getCardholderPresentCode()
    {
        return $this->getParameter('CardholderPresentCode');
    }

    public function setCardholderPresentCode(CardholderPresentCode $value)
    {
        return $this->setParameter('CardholderPresentCode', $value);
    }

    public function getCardInputCode()
    {
        return $this->getParameter('CardInputCode');
    }

    public function setCardInputCode(CardInputCode $value)
    {
        return $this->setParameter('CardInputCode', $value);
    }

    public function getCVVPresenceCode()
    {
        return $this->getParameter('CVVPresenceCode');
    }

    public function setCVVPresenceCode(CVVPresenceCode $value)
    {
        return $this->setParameter('CVVPresenceCode', $value);
    }

    public function getTerminalCapabilityCode()
    {
        return $this->getParameter('TerminalCapabilityCode');
    }

    public function setTerminalCapabilityCode(TerminalCapabilityCode $value)
    {
        return $this->setParameter('TerminalCapabilityCode', $value);
    }

    public function getTerminalEnvironmentCode()
    {
        return $this->getParameter('TerminalEnvironmentCode');
    }

    public function setTerminalEnvironmentCode(TerminalEnvironmentCode $value)
    {
        return $this->setParameter('TerminalEnvironmentCode', $value);
    }

    public function getMotoECICode()
    {
        return $this->getParameter('MotoECICode');
    }

    public function setMotoECICode(MotoECICode $value)
    {
        return $this->setParameter('MotoECICode', $value);
    }

    public function getTerminalSerialNumber()
    {
        return $this->getParameter('TerminalSerialNumber');
    }

    public function setTerminalSerialNumber($value)
    {
        return $this->setParameter('TerminalSerialNumber', $value);
    }
}
