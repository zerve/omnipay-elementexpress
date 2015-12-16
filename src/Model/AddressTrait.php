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

trait AddressTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getAddressModel()
    {
        $model = new Address();
        return $model->initialize($this->getParameters());
    }

    public function getBillingName()
    {
        return $this->getParameter('BillingName');
    }

    public function setBillingName($value)
    {
        return $this->setParameter('BillingName', $value);
    }

    public function getBillingEmail()
    {
        return $this->getParameter('BillingEmail');
    }

    public function setBillingEmail($value)
    {
        return $this->setParameter('BillingEmail', $value);
    }

    public function getBillingPhone()
    {
        return $this->getParameter('BillingPhone');
    }

    public function setBillingPhone($value)
    {
        return $this->setParameter('BillingPhone', $value);
    }

    public function getBillingAddress1()
    {
        return $this->getParameter('BillingAddress1');
    }

    public function setBillingAddress1($value)
    {
        return $this->setParameter('BillingAddress1', $value);
    }

    public function getBillingAddress2()
    {
        return $this->getParameter('BillingAddress2');
    }

    public function setBillingAddress2($value)
    {
        return $this->setParameter('BillingAddress2', $value);
    }

    public function getBillingCity()
    {
        return $this->getParameter('BillingCity');
    }

    public function setBillingCity($value)
    {
        return $this->setParameter('BillingCity', $value);
    }

    public function getBillingState()
    {
        return $this->getParameter('BillingState');
    }

    public function setBillingState($value)
    {
        return $this->setParameter('BillingState', $value);
    }

    public function getBillingZipcode()
    {
        return $this->getParameter('BillingZipcode');
    }

    public function setBillingZipcode($value)
    {
        return $this->setParameter('BillingZipcode', $value);
    }

    public function getShippingName()
    {
        return $this->getParameter('ShippingName');
    }

    public function setShippingName($value)
    {
        return $this->setParameter('ShippingName', $value);
    }

    public function getShippingEmail()
    {
        return $this->getParameter('ShippingEmail');
    }

    public function setShippingEmail($value)
    {
        return $this->setParameter('ShippingEmail', $value);
    }

    public function getShippingPhone()
    {
        return $this->getParameter('ShippingPhone');
    }

    public function setShippingPhone($value)
    {
        return $this->setParameter('ShippingPhone', $value);
    }

    public function getShippingAddress1()
    {
        return $this->getParameter('ShippingAddress1');
    }

    public function setShippingAddress1($value)
    {
        return $this->setParameter('ShippingAddress1', $value);
    }

    public function getShippingAddress2()
    {
        return $this->getParameter('ShippingAddress2');
    }

    public function setShippingAddress2($value)
    {
        return $this->setParameter('ShippingAddress2', $value);
    }

    public function getShippingCity()
    {
        return $this->getParameter('ShippingCity');
    }

    public function setShippingCity($value)
    {
        return $this->setParameter('ShippingCity', $value);
    }

    public function getShippingState()
    {
        return $this->getParameter('ShippingState');
    }

    public function setShippingState($value)
    {
        return $this->setParameter('ShippingState', $value);
    }

    public function getShippingZipcode()
    {
        return $this->getParameter('ShippingZipcode');
    }

    public function setShippingZipcode($value)
    {
        return $this->setParameter('ShippingZipcode', $value);
    }
}
