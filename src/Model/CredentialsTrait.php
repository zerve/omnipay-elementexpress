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

trait CredentialsTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getCredentialsModel()
    {
        $model = new Credentials();
        return $model->initialize($this->getParameters());
    }

    public function getAccountID()
    {
        return $this->getParameter('AccountID');
    }

    public function setAccountID($value)
    {
        return $this->setParameter('AccountID', $value);
    }

    public function getAccountToken()
    {
        return $this->getParameter('AccountToken');
    }

    public function setAccountToken($value)
    {
        return $this->setParameter('AccountToken', $value);
    }

    public function getAcceptorID()
    {
        return $this->getParameter('AcceptorID');
    }

    public function setAcceptorID($value)
    {
        return $this->setParameter('AcceptorID', $value);
    }

    public function getNewAccountToken()
    {
        return $this->getParameter('NewAccountToken');
    }

    public function setNewAccountToken($value)
    {
        return $this->setParameter('NewAccountToken', $value);
    }
}
