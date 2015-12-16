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
            'BillingName: too-long'          => ['BillingName', str_repeat('x', 101)],
            'BillingEmail: too-long'         => ['BillingEmail', sprintf("%'x37s@%'y39s.com", 'devops', 'zerve')],
            'BillingEmail: bad-format'       => ['BillingEmail', 'devopszerve.com'],
            'BillingPhone: too-long'         => ['BillingPhone', str_repeat('x', 21)],
            'BillingAddress1: too-long'      => ['BillingAddress1', str_repeat('x', 51)],
            'BillingAddress2: too-long'      => ['BillingAddress2', str_repeat('x', 51)],
            'BillingCity: too-long'          => ['BillingCity', str_repeat('x', 41)],
            'BillingState: too-long'         => ['BillingState', str_repeat('x', 31)],
            'BillingZipcode: too-long'       => ['BillingZipcode', str_repeat('x', 21)],
            'ShippingName: too-long'         => ['ShippingName', str_repeat('x', 101)],
            'ShippingEmail: too-long'        => ['ShippingEmail', sprintf("%'x37s@%'y39s.com", 'devops', 'zerve')],
            'ShippingEmail: bad-format'      => ['ShippingEmail', 'devopszerve.com'],
            'ShippingPhone: too-long'        => ['ShippingPhone', str_repeat('x', 21)],
            'ShippingAddress1: too-long'     => ['ShippingAddress1', str_repeat('x', 51)],
            'ShippingAddress2: too-long'     => ['ShippingAddress2', str_repeat('x', 51)],
            'ShippingCity: too-long'         => ['ShippingCity', str_repeat('x', 41)],
            'ShippingState: too-long'        => ['ShippingState', str_repeat('x', 31)],
            'ShippingZipcode: too-long'      => ['ShippingZipcode', str_repeat('x', 21)],
        ];
    }

    public function validData()
    {
        return [
            'BillingName: max-length'          => ['BillingName', str_repeat('x', 100)],
            'BillingEmail: max-length'         => ['BillingEmail', sprintf("%'x37s@%'y38s.com", 'devops', 'zerve')],
            'BillingPhone: max-length'         => ['BillingPhone', str_repeat('x', 20)],
            'BillingAddress1: max-length'      => ['BillingAddress1', str_repeat('x', 50)],
            'BillingAddress2: max-length'      => ['BillingAddress2', str_repeat('x', 50)],
            'BillingCity: max-length'          => ['BillingCity', str_repeat('x', 40)],
            'BillingState: max-length'         => ['BillingState', str_repeat('x', 30)],
            'BillingZipcode: max-length'       => ['BillingZipcode', str_repeat('x', 20)],
            'ShippingName: max-length'         => ['ShippingName', str_repeat('x', 100)],
            'ShippingEmail: max-length'        => ['ShippingEmail', sprintf("%'x37s@%'y38s.com", 'devops', 'zerve')],
            'ShippingPhone: max-length'        => ['ShippingPhone', str_repeat('x', 20)],
            'ShippingAddress1: max-length'     => ['ShippingAddress1', str_repeat('x', 50)],
            'ShippingAddress2: max-length'     => ['ShippingAddress2', str_repeat('x', 50)],
            'ShippingCity: max-length'         => ['ShippingCity', str_repeat('x', 40)],
            'ShippingState: max-length'        => ['ShippingState', str_repeat('x', 30)],
            'ShippingZipcode: max-length'      => ['ShippingZipcode', str_repeat('x', 20)],
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
