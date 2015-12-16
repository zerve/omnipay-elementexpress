<?php
/**
 * Copyright 2015 Zerve, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\CardPresentCode;
use Omnipay\ElementExpress\Enumeration\CardholderPresentCode;
use Omnipay\ElementExpress\Enumeration\CardInputCode;
use Omnipay\ElementExpress\Enumeration\CVVPresenceCode;
use Omnipay\ElementExpress\Enumeration\TerminalCapabilityCode;
use Omnipay\ElementExpress\Enumeration\TerminalEnvironmentCode;
use Omnipay\ElementExpress\Enumeration\TerminalType;
use Omnipay\ElementExpress\Enumeration\MotoECICode;

trait TerminalTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getTerminalModel()
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

    public function getTerminalType()
    {
        return $this->getParameter('TerminalType');
    }

    public function setTerminalType($value)
    {
        $value = TerminalType::memberByValue($value)->value();
        return $this->setParameter('TerminalType', $value);
    }

    public function getCardPresentCode()
    {
        return $this->getParameter('CardPresentCode');
    }

    public function setCardPresentCode($value)
    {
        $value = CardPresentCode::memberByValue($value)->value();
        return $this->setParameter('CardPresentCode', $value);
    }

    public function getCardholderPresentCode()
    {
        return $this->getParameter('CardholderPresentCode');
    }

    public function setCardholderPresentCode($value)
    {
        $value = CardholderPresentCode::memberByValue($value)->value();
        return $this->setParameter('CardholderPresentCode', $value);
    }

    public function getCardInputCode()
    {
        return $this->getParameter('CardInputCode');
    }

    public function setCardInputCode($value)
    {
        $value = CardInputCode::memberByValue($value)->value();
        return $this->setParameter('CardInputCode', $value);
    }

    public function getCVVPresenceCode()
    {
        return $this->getParameter('CVVPresenceCode');
    }

    public function setCVVPresenceCode($value)
    {
        $value = CVVPresenceCode::memberByValue($value)->value();
        return $this->setParameter('CVVPresenceCode', $value);
    }

    public function getTerminalCapabilityCode()
    {
        return $this->getParameter('TerminalCapabilityCode');
    }

    public function setTerminalCapabilityCode($value)
    {
        $value = TerminalCapabilityCode::memberByValue($value)->value();
        return $this->setParameter('TerminalCapabilityCode', $value);
    }

    public function getTerminalEnvironmentCode()
    {
        return $this->getParameter('TerminalEnvironmentCode');
    }

    public function setTerminalEnvironmentCode($value)
    {
        $value = TerminalEnvironmentCode::memberByValue($value)->value();
        return $this->setParameter('TerminalEnvironmentCode', $value);
    }

    public function getMotoECICode()
    {
        return $this->getParameter('MotoECICode');
    }

    public function setMotoECICode($value)
    {
        $value = MotoECICode::memberByValue($value)->value();
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
