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

trait PaymentAccountParametersTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getPaymentAccountParametersModel()
    {
        $model = new PaymentAccountParameters();
        return $model->initialize($this->getParameters());
    }

    public function getPaymentAccountID()
    {
        return $this->getParameter('PaymentAccountID');
    }

    public function setPaymentAccountID($value)
    {
        return $this->setParameter('PaymentAccountID', $value);
    }

    public function getPaymentAccountType()
    {
        return $this->getParameter('PaymentAccountType');
    }

    public function setPaymentAccountType($value)
    {
        $value = PaymentAccountType::memberByValue($value)->value();
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

    public function getPaymentBrand()
    {
        return $this->getParameter('PaymentBrand');
    }

    public function setPaymentBrand($value)
    {
        return $this->setParameter('PaymentBrand', $value);
    }

    public function getExpirationMonthBegin()
    {
        return $this->getParameter('ExpirationMonthBegin');
    }

    public function setExpirationMonthBegin($value)
    {
        return $this->setParameter('ExpirationMonthBegin', $value);
    }

    public function getExpirationMonthEnd()
    {
        return $this->getParameter('ExpirationMonthEnd');
    }

    public function setExpirationMonthEnd($value)
    {
        return $this->setParameter('ExpirationMonthEnd', $value);
    }

    public function getExpirationYearBegin()
    {
        return $this->getParameter('ExpirationYearBegin');
    }

    public function setExpirationYearBegin($value)
    {
        return $this->setParameter('ExpirationYearBegin', $value);
    }

    public function getExpirationYearEnd()
    {
        return $this->getParameter('ExpirationYearEnd');
    }

    public function setExpirationYearEnd($value)
    {
        return $this->setParameter('ExpirationYearEnd', $value);
    }
}
