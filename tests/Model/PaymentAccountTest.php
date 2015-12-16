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

use Omnipay\ElementExpress\Model\PaymentAccount;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\Tests\TestCase;

class PaymentAccountTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'PaymentAccountID: too-long'              => ['PaymentAccountID', str_repeat('x', 51)],
            'PaymentAccountType: invalid-value'       => ['PaymentAccountType', 'invalid-value'],
            'PaymentAccountReferenceNumber: too-long' => ['PaymentAccountReferenceNumber', str_repeat('x', 51)],
        ];
    }

    public function validData()
    {
        return [
            'PaymentAccountID: max-length'              => ['PaymentAccountID', str_repeat('x', 50)],
            'PaymentAccountType: valid-enum'            => ['PaymentAccountType', PaymentAccountType::CREDIT_CARD],
            'PaymentAccountReferenceNumber: max-length' => ['PaymentAccountReferenceNumber', str_repeat('x', 50)],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new PaymentAccount();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new PaymentAccount();
        $model[$field] = $value;
        $model->validate();
    }
}
