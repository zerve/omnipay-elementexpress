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

    // The following mutators/accessors correspond to parameters that have
    // Omnipay equivalents. These are named with the Omnipay convention and
    // mapped to the ElementExpress domain in the model.

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getTransactionId()
    {
        return $this->getParameter('transactionId');
    }

    public function setTransactionId($value)
    {
        return $this->setParameter('transactionId', $value);
    }

    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
    }

    public function setTransactionReference($value)
    {
        return $this->setParameter('transactionReference', $value);
    }

    // The following mutators/accessors correspond to parameters that are
    // unique to the ElementExpress domain.

    public function getMarketCode()
    {
        return $this->getParameter('MarketCode');
    }

    public function setMarketCode(MarketCode $value)
    {
        return $this->setParameter('MarketCode', $value);
    }

    public function getReversalType()
    {
        return $this->getParameter('ReversalType');
    }

    public function setReversalType(ReversalType $value)
    {
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
}
