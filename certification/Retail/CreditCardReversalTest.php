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
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '200.00',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then reverse the sale
        $response = $this->gw->creditCardReversal($this->optsRetailSwiped([
            'TransactionAmount'       => '200.00',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
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
            $response->getTransactionId()
        ]);
    }

    public function testVisaPerformFullReversalOfPriorSale()
    {
        // First create a sale to reverse.
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '200.01',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then reverse the sale
        $response = $this->gw->creditCardReversal($this->optsRetailKeyed([
            'TransactionAmount' => '200.01',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'TransactionID'     => $response->getTransactionId(),
            'ReversalType'      => ReversalType::FULL(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Full Reversal of prior Sale)',
            '200.01',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }
}
