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

use Omnipay\ElementExpress\Enumeration\PaymentAccountType;

trait PaymentAccountTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getPaymentAccountModel()
    {
        $model = new PaymentAccount();
        return $model->initialize($this->getParameters());
    }

    // The following mutators/accessors correspond to parameters that have
    // Omnipay equivalents. These are named with the Omnipay convention and
    // mapped to the ElementExpress domain in the model.

    public function getCardReference()
    {
        return $this->getParameter('cardReference');
    }

    public function setCardReference($value)
    {
        return $this->setParameter('cardReference', $value);
    }

    // The following mutators/accessors correspond to parameters that are
    // unique to the ElementExpress domain.

    public function getPaymentAccountType()
    {
        return $this->getParameter('PaymentAccountType');
    }

    public function setPaymentAccountType(PaymentAccountType $value)
    {
        return $this->setParameter('PaymentAccountType', $value);
    }

    public function getPaymentAccountReferenceNumber()
    {
        return $this->getParameter('PaymentAccountReferenceNumber');
    }

    public function setPaymentAccountReferenceNumber($value)
    {
        return $this->setParameter('PaymentAccountReferenceNumber', $value);
    }
}
