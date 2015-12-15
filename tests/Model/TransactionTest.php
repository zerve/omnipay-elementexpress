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

use Omnipay\ElementExpress\Model\Transaction;
use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\ElementExpress\Enumeration\ReversalType;
use Omnipay\Tests\TestCase;

class TransactionTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'amount: too-long'                    => ['amount', str_repeat('9', 11)],
            'amount: bad-format (decimals)'       => ['amount', '1.11.1'],
            'amount: bad-format (alpha)'          => ['amount', '1.11.1'],
            'amount: bad-format (negative)'       => ['amount', '-1.00'],
            'ReversalType: invalid-value'         => ['ReversalType', 0],
            'MarketCode: invalid-value'           => ['MarketCode', 0],
            'transactionReference: too-long'      => ['transactionReference', str_repeat('x', 11)],
            'transactionId: too-long'             => ['transactionId', str_repeat('x', 51)],
            'PartialApprovedFlag: non-bool'       => ['PartialApprovedFlag', '5'],
            'DuplicateOverrideFlag: non-bool'     => ['DuplicateOverrideFlag', '5'],
            'DuplicateCheckDisableFlag: non-bool' => ['DuplicateCheckDisableFlag', '5'],
        ];
    }

    public function validData()
    {
        return [
            'amount: max-length'               => ['amount', str_repeat('9', 10)],
            'amount: valid (1 decimal)'        => ['amount', '1.2'],
            'amount: valid (2 decimal)'        => ['amount', '1.25'],
            'amount: valid (3 decimal)'        => ['amount', '1.253'],
            'ReversalType: valid-enum'         => ['ReversalType', ReversalType::PARTIAL()],
            'MarketCode: valid-enum'           => ['MarketCode', MarketCode::__DEFAULT()],
            'transactionReference: max-length' => ['transactionReference', str_repeat('x', 10)],
            'transactionId: max-length'        => ['transactionId', str_repeat('x', 50)],
            'PartialApprovedFlag: true'        => ['PartialApprovedFlag', "1"],
            'PartialApprovedFlag: false'       => ['PartialApprovedFlag', "0"],
            'DuplicateOverrideFlag: true'      => ['DuplicateOverrideFlag', "1"],
            'DuplicateOverrideFlag: false'     => ['DuplicateOverrideFlag', "0"],
            'DuplicateCheckDisableFlag: true'  => ['DuplicateCheckDisableFlag', "1"],
            'DuplicateCheckDisableFlag: false' => ['DuplicateCheckDisableFlag', "0"],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new Transaction();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new Transaction();
        $model[$field] = $value;
        $model->validate();
    }
}
