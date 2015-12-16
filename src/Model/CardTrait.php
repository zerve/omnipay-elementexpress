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

use Omnipay\ElementExpress\Enumeration\EncryptedFormat;

trait CardTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getCardModel()
    {
        $model = new Card();
        return $model->initialize($this->getParameters());
    }

    public function getCardNumber()
    {
        return $this->getParameter('CardNumber');
    }

    public function setCardNumber($value)
    {
        return $this->setParameter('CardNumber', $value);
    }

    public function getExpirationMonth()
    {
        return $this->getParameter('ExpirationMonth');
    }

    public function setExpirationMonth($value)
    {
        return $this->setParameter('ExpirationMonth', $value);
    }

    public function getExpirationYear()
    {
        return $this->getParameter('ExpirationYear');
    }

    public function setExpirationYear($value)
    {
        return $this->setParameter('ExpirationYear', $value);
    }

    public function getCVV()
    {
        return $this->getParameter('CVV');
    }

    public function setCVV($value)
    {
        return $this->setParameter('CVV', $value);
    }

    public function getTrack1Data()
    {
        return $this->getParameter('Track1Data');
    }

    public function setTrack1Data($value)
    {
        return $this->setParameter('Track1Data', $value);
    }

    public function getTrack2Data()
    {
        return $this->getParameter('Track2Data');
    }

    public function setTrack2Data($value)
    {
        return $this->setParameter('Track2Data', $value);
    }

    public function getMagneprintData()
    {
        return $this->getParameter('MagneprintData');
    }

    public function setMagneprintData($value)
    {
        return $this->setParameter('MagneprintData', $value);
    }

    public function getEncryptedTrack1Data()
    {
        return $this->getParameter('EncryptedTrack1Data');
    }

    public function setEncryptedTrack1Data($value)
    {
        return $this->setParameter('EncryptedTrack1Data', $value);
    }

    public function getEncryptedTrack2Data()
    {
        return $this->getParameter('EncryptedTrack2Data');
    }

    public function setEncryptedTrack2Data($value)
    {
        return $this->setParameter('EncryptedTrack2Data', $value);
    }

    public function getEncryptedCardData()
    {
        return $this->getParameter('EncryptedCardData');
    }

    public function setEncryptedCardData($value)
    {
        return $this->setParameter('EncryptedCardData', $value);
    }

    public function getCardDataKeySerialNumber()
    {
        return $this->getParameter('CardDataKeySerialNumber');
    }

    public function setCardDataKeySerialNumber($value)
    {
        return $this->setParameter('CardDataKeySerialNumber', $value);
    }

    public function getEncryptedFormat()
    {
        return $this->getParameter('EncryptedFormat');
    }

    public function setEncryptedFormat($value)
    {
        $value = EncryptedFormat::memberByValue($value)->value();
        return $this->setParameter('EncryptedFormat', $value);
    }
}
