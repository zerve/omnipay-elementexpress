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

use Omnipay\ElementExpress\Model\Address;
use Omnipay\Tests\TestCase;

class AddressTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'billingName: too-long'          => ['billingName', str_repeat('x', 101)],
            'billingPhone: too-long'         => ['billingPhone', str_repeat('x', 21)],
            'billingEmail: too-long'         => ['billingEmail', sprintf("%'x37s@%'y39s.com", 'devops', 'zerve')],
            'billingEmail: bad-format'       => ['billingEmail', 'devopszerve.com'],
            'billingAddress1: too-long'      => ['billingAddress1', str_repeat('x', 51)],
            'billingAddress2: too-long'      => ['billingAddress2', str_repeat('x', 51)],
            'billingCity: too-long'          => ['billingCity', str_repeat('x', 41)],
            'billingState: too-long'         => ['billingState', str_repeat('x', 31)],
            'billingPostcode: too-long'      => ['billingPostcode', str_repeat('x', 21)],
            'shippingName: too-long'         => ['shippingName', str_repeat('x', 101)],
            'shippingEmail: too-long'        => ['shippingEmail', sprintf("%'x37s@%'y39s.com", 'devops', 'zerve')],
            'shippingEmail: bad-format'      => ['shippingEmail', 'devopszerve.com'],
            'shippingPhone: too-long'        => ['shippingPhone', str_repeat('x', 21)],
            'shippingAddress1: too-long'     => ['shippingAddress1', str_repeat('x', 51)],
            'shippingAddress2: too-long'     => ['shippingAddress2', str_repeat('x', 51)],
            'shippingCity: too-long'         => ['shippingCity', str_repeat('x', 41)],
            'shippingState: too-long'        => ['shippingState', str_repeat('x', 31)],
            'shippingPostcode: too-long'     => ['shippingPostcode', str_repeat('x', 21)],
        ];
    }

    public function validData()
    {
        return [
            'billingName: max-length'          => ['billingName', str_repeat('x', 100)],
            'billingEmail: max-length'         => ['billingEmail', sprintf("%'x37s@%'y38s.com", 'devops', 'zerve')],
            'billingPhone: max-length'         => ['billingPhone', str_repeat('x', 20)],
            'billingAddress1: max-length'      => ['billingAddress1', str_repeat('x', 50)],
            'billingAddress2: max-length'      => ['billingAddress2', str_repeat('x', 50)],
            'billingCity: max-length'          => ['billingCity', str_repeat('x', 40)],
            'billingState: max-length'         => ['billingState', str_repeat('x', 30)],
            'billingPostcode: max-length'      => ['billingPostcode', str_repeat('x', 20)],
            'shippingName: max-length'         => ['shippingName', str_repeat('x', 100)],
            'shippingEmail: max-length'        => ['shippingEmail', sprintf("%'x37s@%'y38s.com", 'devops', 'zerve')],
            'shippingPhone: max-length'        => ['shippingPhone', str_repeat('x', 20)],
            'shippingAddress1: max-length'     => ['shippingAddress1', str_repeat('x', 50)],
            'shippingAddress2: max-length'     => ['shippingAddress2', str_repeat('x', 50)],
            'shippingCity: max-length'         => ['shippingCity', str_repeat('x', 40)],
            'shippingState: max-length'        => ['shippingState', str_repeat('x', 30)],
            'shippingPostcode: max-length'     => ['shippingPostcode', str_repeat('x', 20)],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new Address();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new Address();
        $model[$field] = $value;
        $model->validate();
    }
}
