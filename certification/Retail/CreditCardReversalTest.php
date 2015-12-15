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

namespace Omnipay\ElementExpress\Certification\Retail;

use Omnipay\ElementExpress\Certification\CertificationTestCase;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;
use Omnipay\ElementExpress\Enumeration\ReversalType;

/**
 * @group certification
 */
class CreditCardReversalTest extends CertificationTestCase
{
    protected static $testDescription = 'Credit Card Reversal';

    public function testVisaPerformSystemReversalOfPriorSale()
    {
        // First create a sale to reverse.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '200.00',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then reverse the sale
        $response = $this->gw->expressReversal($this->optsRetailSwiped([
            'amount'                  => '200.00',
            'transactionId'           => uniqid(),
            'ReversalType'            => ReversalType::SYSTEM(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform System Reversal of prior Sale)',
            '200.00',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaPerformFullReversalOfPriorSale()
    {
        // First create a sale to reverse.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '200.01',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then reverse the sale
        $response = $this->gw->expressReversal($this->optsRetailKeyed([
            'amount'                  => '200.01',
            'transactionId'           => uniqid(),
            'transactionReference'    => $response->getTransactionReference(),
            'ReversalType'            => ReversalType::FULL(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Full Reversal of prior Sale)',
            '200.01',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }
}
