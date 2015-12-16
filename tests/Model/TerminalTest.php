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

use Omnipay\ElementExpress\Model\Terminal;
use Omnipay\ElementExpress\Enumeration\CardPresentCode;
use Omnipay\ElementExpress\Enumeration\CardholderPresentCode;
use Omnipay\ElementExpress\Enumeration\CardInputCode;
use Omnipay\ElementExpress\Enumeration\CVVPresenceCode;
use Omnipay\ElementExpress\Enumeration\TerminalCapabilityCode;
use Omnipay\ElementExpress\Enumeration\TerminalEnvironmentCode;
use Omnipay\ElementExpress\Enumeration\TerminalType;
use Omnipay\ElementExpress\Enumeration\MotoECICode;
use Omnipay\Tests\TestCase;

class TerminalTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'TerminalID: too-long'                   => ['TerminalID', str_repeat('x', 41)],
            'TerminalType: invalid-value'            => ['TerminalType', 0],
            'TerminalCapabilityCode: invalid-value'  => ['TerminalCapabilityCode', 0],
            'TerminalEnvironmentCode: invalid-value' => ['TerminalEnvironmentCode', 0],
            'CardPresentCode: invalid-value'         => ['CardPresentCode', 0],
            'CVVPresenceCode: invalid-value'         => ['CVVPresenceCode', 0],
            'CardInputCode: invalid-value'           => ['CardInputCode', 0],
            'CardholderPresentCode: invalid-value'   => ['CardholderPresentCode', 0],
            'MotoECICode: invalid-value'             => ['MotoECICode', 0],
            'TerminalSerialNumber: too-long'         => ['TerminalSerialNumber', str_repeat('x', 41)],
        ];
    }

    public function validData()
    {
        return [
            'TerminalID: max-length'                 => ['TerminalID', str_repeat('x', 40)],
            'TerminalType: valid-enum'               => ['TerminalType', TerminalType::UNKNOWN()],
            'TerminalCapabilityCode: valid-enum'     => ['TerminalCapabilityCode', TerminalCapabilityCode::__DEFAULT()],
            'TerminalEnvironmentCode: valid-enum'    => ['TerminalEnvironmentCode', TerminalEnvironmentCode::__DEFAULT()],
            'CardPresentCode: valid-enum'            => ['CardPresentCode', CardPresentCode::__DEFAULT()],
            'CVVPresenceCode: valid-enum'            => ['CVVPresenceCode', CVVPresenceCode::__DEFAULT()],
            'CardInputCode: valid-enum'              => ['CardInputCode', CardInputCode::__DEFAULT()],
            'CardholderPresentCode: valid-enum'      => ['CardholderPresentCode', CardholderPresentCode::__DEFAULT()],
            'MotoECICode: valid-enum'                => ['MotoECICode', MotoECICode::__DEFAULT()],
            'TerminalSerialNumber: max-length'       => ['TerminalSerialNumber', str_repeat('x', 40)],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new Terminal();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new Terminal();
        $model[$field] = $value;
        $model->validate();
    }
}
