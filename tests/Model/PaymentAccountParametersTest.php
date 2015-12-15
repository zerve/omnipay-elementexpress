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

use Omnipay\ElementExpress\Model\PaymentAccountParameters;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\Tests\TestCase;

class PaymentAccountParametersTest extends TestCase
{
    //
    // ExpirationMonthBegin/End and ExpirationYearBegin/End Validation
    //

    public function invalidExpirationData()
    {
        return [
            'bad-year-order'  => ['01', '15', '01', '14'],
            'bad-month-order' => ['02', '15', '01', '15'],
        ];
    }

    public function validExpirationData()
    {
        return [
            'same-year'      => ['01', '15', '05', '15'],
            'different-year' => ['01', '15', '01', '16'],
            'same-values'    => ['01', '15', '01', '15'],
        ];
    }

    /**
     * @dataProvider invalidExpirationData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testExpirationDataFails($mBegin, $yBegin, $mEnd, $yEnd)
    {
        $model = new PaymentAccountParameters();
        $model['ExpirationMonthBegin'] = $mBegin;
        $model['ExpirationYearBegin']  = $yBegin;
        $model['ExpirationMonthEnd']   = $mEnd;
        $model['ExpirationYearEnd']    = $yEnd;
        $model->validate();
    }

    /**
     * @dataProvider validExpirationData
     */
    public function testExpirationDataSucceeds($mBegin, $yBegin, $mEnd, $yEnd)
    {
        $model = new PaymentAccountParameters();
        $model['ExpirationMonthBegin'] = $mBegin;
        $model['ExpirationYearBegin']  = $yBegin;
        $model['ExpirationMonthEnd']   = $mEnd;
        $model['ExpirationYearEnd']    = $yEnd;
        $model->validate();
    }

    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'cardReference: too-long'                 => ['cardReference', str_repeat('x', 51)],
            'PaymentAccountType: invalid-value'       => ['PaymentAccountType', 0],
            'PaymentAccountReferenceNumber: too-long' => ['PaymentAccountReferenceNumber', str_repeat('x', 51)],
            'PaymentBrand: too-long'                  => ['PaymentBrand', str_repeat('x', 51)],
            'ExpirationMonthBegin: single-digit'      => ['ExpirationMonthBegin', '1'],
            'ExpirationMonthBegin: invalid-month'     => ['ExpirationMonthBegin', '13'],
            'ExpirationMonthBegin: not-digits'        => ['ExpirationMonthBegin', 'a1'],
            'ExpirationMonthEnd: single-digit'        => ['ExpirationMonthEnd', '1'],
            'ExpirationMonthEnd: invalid-month'       => ['ExpirationMonthEnd', '13'],
            'ExpirationMonthEnd: not-digits'          => ['ExpirationMonthEnd', 'a1'],
            'ExpirationYearBegin: single-digit'       => ['ExpirationYearBegin', '1'],
            'ExpirationYearBegin: not-digits'         => ['ExpirationYearBegin', 'a1'],
            'ExpirationYearBegin: invalid-year'       => ['ExpirationYearBegin', '100'],
            'ExpirationYearEnd: single-digit'         => ['ExpirationYearEnd', '1'],
            'ExpirationYearEnd: not-digits'           => ['ExpirationYearEnd', 'a1'],
            'ExpirationYearEnd: invalid-year'         => ['ExpirationYearEnd', '100'],
        ];
    }

    public function validData()
    {
        return [
            'cardReference: max-length'                 => ['cardReference', str_repeat('x', 50)],
            'PaymentAccountType: valid-enum'            => ['PaymentAccountType', PaymentAccountType::CREDIT_CARD()],
            'PaymentAccountReferenceNumber: max-length' => ['PaymentAccountReferenceNumber', str_repeat('x', 50)],
            'PaymentBrand: max-length'                  => ['PaymentBrand', str_repeat('x', 50)],
            'ExpirationMonthBegin: min-val'             => ['ExpirationMonthBegin', '01'],
            'ExpirationMonthBegin: max-val'             => ['ExpirationMonthBegin', '12'],
            'ExpirationMonthEnd: min-val'               => ['ExpirationMonthEnd', '01'],
            'ExpirationMonthEnd: max-val'               => ['ExpirationMonthEnd', '12'],
            'ExpirationYearBegin: min-val'              => ['ExpirationYearBegin', '00'],
            'ExpirationYearBegin: max-val'              => ['ExpirationYearBegin', '99'],
            'ExpirationYearEnd: min-val'                => ['ExpirationYearEnd', '00'],
            'ExpirationYearEnd: max-val'                => ['ExpirationYearEnd', '99'],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new PaymentAccountParameters();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new PaymentAccountParameters();
        $model[$field] = $value;
        $model->validate();
    }
}
