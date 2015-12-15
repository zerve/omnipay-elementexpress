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

trait ApplicationTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    public function getApplicationModel()
    {
        $model = new Application();
        return $model->initialize($this->getParameters());
    }

    public function getApplicationID()
    {
        return $this->getParameter('ApplicationID');
    }

    public function setApplicationID($value)
    {
        return $this->setParameter('ApplicationID', $value);
    }

    public function getApplicationName()
    {
        return $this->getParameter('ApplicationName');
    }

    public function setApplicationName($value)
    {
        return $this->setParameter('ApplicationName', $value);
    }

    public function getApplicationVersion()
    {
        return $this->getParameter('ApplicationVersion');
    }

    public function setApplicationVersion($value)
    {
        return $this->setParameter('ApplicationVersion', $value);
    }
}
