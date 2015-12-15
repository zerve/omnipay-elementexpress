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

use Omnipay\ElementExpress\Model\Credentials;
use Omnipay\Tests\TestCase;

class CredentialsTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'AccountID: too-long'       => ['AccountID', str_repeat('x', 11)],
            'AccountToken: too-long'    => ['AccountToken', str_repeat('x', 141)],
            'AcceptorID: too-long'      => ['AcceptorID', str_repeat('x', 51)],
            'NewAccountToken: too-long' => ['NewAccountToken', str_repeat('x', 141)],
        ];
    }

    public function validData()
    {
        return [
            'AccountID: max-length'       => ['AccountID', str_repeat('x', 10)],
            'AccountToken: max-length'    => ['AccountToken', str_repeat('x', 140)],
            'AcceptorID: max-length'      => ['AcceptorID', str_repeat('x', 50)],
            'NewAccountToken: max-length' => ['NewAccountToken', str_repeat('x', 140)],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new Credentials();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new Credentials();
        $model[$field] = $value;
        $model->validate();
    }
}
