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
            'TransactionID: too-long'                  => ['TransactionID', str_repeat('x', 11)],
            'TransactionAmount: too-long'              => ['TransactionAmount', str_repeat('9', 11)],
            'TransactionAmount: bad-format (decimals)' => ['TransactionAmount', '1.11.1'],
            'TransactionAmount: bad-format (alpha)'    => ['TransactionAmount', '1.11.1'],
            'TransactionAmount: bad-format (negative)' => ['TransactionAmount', '-1.00'],
            'ReferenceNumber: too-long'                => ['ReferenceNumber', str_repeat('x', 51)],
            'ReversalType: invalid-value'              => ['ReversalType', 0],
            'MarketCode: invalid-value'                => ['MarketCode', 0],
            'DuplicateCheckDisableFlag: non-bool'      => ['DuplicateCheckDisableFlag', '5'],
            'DuplicateOverrideFlag: non-bool'          => ['DuplicateOverrideFlag', '5'],
            'TicketNumber: too-long'                   => ['TicketNumber', str_repeat('x', 51)],
            'PartialApprovedFlag: non-bool'            => ['PartialApprovedFlag', '5'],
        ];
    }

    public function validData()
    {
        return [
            'TransactionID: max-length'            => ['TransactionID', str_repeat('x', 10)],
            'TransactionAmount: max-length'        => ['TransactionAmount', str_repeat('9', 10)],
            'TransactionAmount: valid (1 decimal)' => ['TransactionAmount', '1.2'],
            'TransactionAmount: valid (2 decimal)' => ['TransactionAmount', '1.25'],
            'TransactionAmount: valid (3 decimal)' => ['TransactionAmount', '1.253'],
            'ReferenceNumber: max-length'          => ['ReferenceNumber', str_repeat('x', 50)],
            'ReversalType: valid-enum'             => ['ReversalType', ReversalType::PARTIAL()],
            'MarketCode: valid-enum'               => ['MarketCode', MarketCode::__DEFAULT()],
            'DuplicateCheckDisableFlag: true'      => ['DuplicateCheckDisableFlag', "1"],
            'DuplicateCheckDisableFlag: false'     => ['DuplicateCheckDisableFlag', "0"],
            'DuplicateOverrideFlag: true'          => ['DuplicateOverrideFlag', "1"],
            'DuplicateOverrideFlag: false'         => ['DuplicateOverrideFlag', "0"],
            'TicketNumber: max-length'             => ['TicketNumber', str_repeat('x', 50)],
            'PartialApprovedFlag: true'            => ['PartialApprovedFlag', "1"],
            'PartialApprovedFlag: false'           => ['PartialApprovedFlag', "0"],
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
