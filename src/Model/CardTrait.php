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

    /**
     * Unlike other getModel() methods, the Card object is initialized using
     * data from the Omnipay 'card' parameter which is an object in the Omnipay
     * domain.
     */
    public function getCardModel()
    {
        $model = new Card();
        $parameters = $this->getParameters();
        if ($card = $this->getParameter('card')) {
            $parameters = array_merge($parameters, $card->getParameters());
        }
        return $model->initialize($parameters);
    }

    // The following mutators/accessors correspond to parameters that have
    // Omnipay equivalents. These are named with the Omnipay convention and
    // mapped to the ElementExpress domain in the model.

    public function getNumber()
    {
        return $this->getParameter('number');
    }

    public function setNumber($value)
    {
        return $this->setParameter('number', $value);
    }

    public function getExpiryMonth()
    {
        return $this->getParameter('expiryMonth');
    }

    public function setExpiryMonth($value)
    {
        return $this->setParameter('expiryMonth', $value);
    }

    public function getExpiryYear()
    {
        return $this->getParameter('expiryYear');
    }

    public function setExpiryYear($value)
    {
        return $this->setParameter('expiryYear', $value);
    }

    public function getCvv()
    {
        return $this->getParameter('cvv');
    }

    public function setCvv($value)
    {
        return $this->setParameter('cvv', $value);
    }

    // The following mutators/accessors correspond to parameters that are
    // unique to the ElementExpress domain.

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

    public function setEncryptedFormat(EncryptedFormat $value)
    {
        return $this->setParameter('EncryptedFormat', $value);
    }
}
