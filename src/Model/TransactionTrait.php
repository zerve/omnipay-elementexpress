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

use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\ElementExpress\Enumeration\ReversalType;

trait TransactionTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getTransactionModel()
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

    public function getReferenceNumber()
    {
        return $this->getParameter('ReferenceNumber');
    }

    public function setReferenceNumber($value)
    {
        return $this->setParameter('ReferenceNumber', $value);
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

    public function setMarketCode($value)
    {
        $value = MarketCode::memberByValue($value)->value();
        return $this->setParameter('MarketCode', $value);
    }

    public function getReversalType()
    {
        return $this->getParameter('ReversalType');
    }

    public function setReversalType($value)
    {
        $value = ReversalType::memberByValue($value)->value();
        return $this->setParameter('ReversalType', $value);
    }

    public function getPartialApprovedFlag()
    {
        return $this->getParameter('PartialApprovedFlag');
    }

    public function setPartialApprovedFlag($value)
    {
        return $this->setParameter('PartialApprovedFlag', $value);
    }

    public function getDuplicateOverrideFlag()
    {
        return $this->getParameter('DuplicateOverrideFlag');
    }

    public function setDuplicateOverrideFlag($value)
    {
        return $this->setParameter('DuplicateOverrideFlag', $value);
    }

    public function getDuplicateCheckDisableFlag()
    {
        return $this->getParameter('DuplicateCheckDisableFlag');
    }

    public function setDuplicateCheckDisableFlag($value)
    {
        return $this->setParameter('DuplicateCheckDisableFlag', $value);
    }

    public function getTicketNumber()
    {
        return $this->getParameter('TicketNumber');
    }

    public function setTicketNumber($value)
    {
        return $this->setParameter('TicketNumber', $value);
    }
}
