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

namespace Omnipay\ElementExpress\Tests\Model;

use Mockery as m;
use Omnipay\Tests\TestCase;

class AbstractModelTest extends TestCase
{
    public function testConstructorSetsParameters()
    {
        $default = array('dflt' => uniqid(), 'custom' => '');
        $custom  = array('custom' => uniqid());

        $model = m::mock('Omnipay\ElementExpress\Model\AbstractModel')->makePartial();
        $model->shouldReceive('getDefaultParameters')->once()->andReturn($default);

        $this->assertSame($model, $model->initialize($custom));
        $this->assertSame($model['dflt'], $default['dflt']);
        $this->assertSame($model['custom'], $custom['custom']);
    }
}
