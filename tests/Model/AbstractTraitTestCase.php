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

use Omnipay\Tests\TestCase;

abstract class AbstractTraitTestCase extends \PHPUnit_Framework_TestCase
{
    protected $mockRequest;
    protected $mockModel;

    abstract public function getMockRequest();
    abstract public function getMockModel();

    public function parameterDataProvider()
    {
        $model = $this->getMockModel();
        foreach ($model->toArray() as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $getter = 'get' . ucfirst($key);
            $value = $value ?: uniqid();
            yield [$setter, $getter, $value];
        }
    }

    /**
     * @dataProvider parameterDataProvider
     */
    public function testParameterAccessors($setter, $getter, $value)
    {
        $request = $this->getMockRequest();
        $this->assertTrue(method_exists($request, $setter), "Trait must implement $setter()");
        $this->assertTrue(method_exists($request, $getter), "Trait must implement $getter()");

        // Setter must provide fluent interface.
        $this->assertSame($request, $request->$setter($value));
        $this->assertSame($value, $request->$getter());
    }

    public function testGetModelsIncludesModelForTrait()
    {
        $request = $this->getMockRequest();
        $models  = array_filter($request->getModels(), function($value) {
            $expectedClass = get_class($this->getMockModel());
            return $value instanceof $expectedClass;
        });
        $this->assertNotEmpty($models);
    }
}
