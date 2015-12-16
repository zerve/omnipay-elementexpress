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

use Omnipay\ElementExpress\Model\Card;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;
use Omnipay\Tests\TestCase;

class CardTest extends TestCase
{
    public function testConditionalEncryptionParametersPresent()
    {
        $data = [
            'EncryptedTrack1Data'     => uniqid(),
            'EncryptedFormat'         => EncryptedFormat::__DEFAULT,
            'CardDataKeySerialNumber' => uniqid(),
        ];

        $doc   = new \DOMDocument('1.0');
        $model = new Card();
        $model->initialize($data)->appendToDom($doc);

        $this->assertSame(1, $doc->getElementsByTagName('EncryptedFormat')->length,
            'Did not find expected "EncryptedFormat" node');
        $this->assertSame(1, $doc->getElementsByTagName('CardDataKeySerialNumber')->length,
            'Did not find expected "CardDataKeySerialNumber" node');
    }

    public function testConditionalEncryptionParametersAbsent()
    {
        $data = [
            'CardNumber'              => uniqid(),
            'EncryptedFormat'         => EncryptedFormat::__DEFAULT,
            'CardDataKeySerialNumber' => uniqid(),
        ];

        $doc   = new \DOMDocument('1.0');
        $model = new Card();
        $model->initialize($data)->appendToDom($doc);

        $this->assertSame(0, $doc->getElementsByTagName('EncryptedFormat')->length,
            'Found unexpected "EncryptedFormat" node');
        $this->assertSame(0, $doc->getElementsByTagName('CardDataKeySerialNumber')->length,
            'Found unexpected "EncryptedFormat" node');
    }

    public function testCardFieldGroupPrecedence()
    {
        // Data needed to initialize card model.
        $data = [
            'MagneprintData'      => uniqid(),
            'EncryptedTrack2Data' => uniqid(),
            'EncryptedTrack1Data' => uniqid(),
            'EncryptedCardData'   => uniqid(),
            'Track2Data'          => uniqid(),
            'Track1Data'          => uniqid(),
            'CardNumber'          => '4111111111111111',
            'ExpirationMonth'     => '01',
            'ExpirationYear'      => gmdate('Y') + 2,
        ];

        // Fields to look for in precedence order.
        $fields = [
            'MagneprintData',
            'EncryptedTrack2Data',
            'EncryptedTrack1Data',
            'EncryptedCardData',
            'Track2Data',
            'Track1Data',
            'CardNumber',
        ];

        while ($fields) {

            $doc   = new \DOMDocument('1.0');
            $model = new Card();
            $model->initialize($data)->appendToDom($doc);

            $this->assertSame(1, $doc->getElementsByTagName(current($fields))->length,
                'Did not find expected "' . current($fields) . '" node');

            // Remove highest precedence element
            array_shift($fields);
            array_shift($data);

        }
    }

    /**
     * Generates a number that passes the Luhn algorithm.
     *
     * @param $len Desired length
     * @return string
     */
    protected function generateValidCardNumber($len = 16)
    {
        // Fill string with random numbers.
        $number = '';
        for ($i = 0; $i < ($len - 1); ++$i) {
            $number .= rand(0, 9);
        }

        // Calculate Luhn so far.
        $str = '';
        foreach (array_reverse(str_split($number)) as $i => $c) {
            $str .= $i % 2 ? $c : $c * 2;
        }
        $sum = array_sum(str_split($str));

        // Chose final digit so that Luhn passes
        $number .= (10 - ($sum % 10)) % 10;
        return (string) $number;
    }

    //
    // ExpirationMonth and ExpirationYear Validation
    //

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testCardExpirationDateValidationFails()
    {
        $card = new Card();
        $card['ExpirationMonth'] = gmdate('m');
        $card['ExpirationYear']  = gmdate('y') - 1;
        $card->validate();
    }

    public function testCardExpirationDateValidationSucceeds()
    {
        $card = new Card();
        $card['ExpirationMonth'] = gmdate('m');
        $card['ExpirationYear']  = gmdate('y') + 1;
        $card->validate();
    }

    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'CardNumber: too-short'             => ['CardNumber', $this->generateValidCardNumber(11)],
            'CardNumber: too-long'              => ['CardNumber', $this->generateValidCardNumber(20)],
            'CardNumber: bad-luhn'              => ['CardNumber', $this->generateValidCardNumber(16) . "99"],
            'Track1Data: too-long'              => ['Track1Data', str_repeat('x', 77)],
            'Track2Data: too-long'              => ['Track2Data', str_repeat('x', 38)],
            'MagneprintData: too-long'          => ['MagneprintData', str_repeat('x', 701)],
            'CVV: too-long'                     => ['CVV', str_repeat('1', 5)],
            'CVV: invalid-chars'                => ['CVV', str_repeat('x', 4)],
            'EncryptedTrack1Data: too-long'     => ['EncryptedTrack1Data', str_repeat('x', 301)],
            'EncryptedTrack2Data: too-long'     => ['EncryptedTrack2Data', str_repeat('x', 201)],
            'EncryptedCardData: too-long'       => ['EncryptedCardData', str_repeat('x', 201)],
            'CardDataKeySerialNumber: too-long' => ['CardDataKeySerialNumber', str_repeat('x', 27)],
            'EncryptedFormat: invalid-value'    => ['EncryptedFormat', 'invalid-value'],
        ];
    }

    public function validData()
    {
        return [
            'CardNumber: lower-bounds'            => ['CardNumber', $this->generateValidCardNumber(12)],
            'CardNumber: upper-bounds'            => ['CardNumber', $this->generateValidCardNumber(19)],
            'Track1Data: max-length'              => ['Track1Data', str_repeat('x', 76)],
            'Track2Data: max-length'              => ['Track2Data', str_repeat('x', 37)],
            'MagneprintData: max-length'          => ['MagneprintData', str_repeat('x', 700)],
            'CVV: 3-digit'                        => ['CVV', str_repeat('1', 3)],
            'CVV: 3-digit'                        => ['CVV', str_repeat('1', 4)],
            'EncryptedTrack1Data: max-length'     => ['EncryptedTrack1Data', str_repeat('x', 300)],
            'EncryptedTrack2Data: max-length'     => ['EncryptedTrack2Data', str_repeat('x', 200)],
            'EncryptedCardData: max-length'       => ['EncryptedCardData', str_repeat('x', 200)],
            'CardDataKeySerialNumber: max-length' => ['CardDataKeySerialNumber', str_repeat('x', 26)],
            'EncryptedFormat: valid-enum'         => ['EncryptedFormat', EncryptedFormat::__DEFAULT],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new Card();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new Card();
        $model[$field] = $value;
        $model->validate();
    }
}
