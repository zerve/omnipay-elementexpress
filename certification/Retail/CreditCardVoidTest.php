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

/**
 * @group certification
 */
class CreditCardVoidTest extends CertificationTestCase
{
    protected static $testDescription = 'Credit Card Void';

    public function testVisaPerformVoidOfPriorSale()
    {
        // First create a sale to void.
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '100.00',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then void the sale
        $response = $this->gw->creditCardVoid($this->optsRetailSwiped([
            'ReferenceNumber' => uniqid(),
            'TicketNumber'    => uniqid(),
            'TransactionID'   => $response->getTransactionId()
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Void of prior Sale)',
            '100.00',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaPerformVoidOfPriorReturn()
    {
        // First create a sale.
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '100.01',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Perform a full return on the previous sale.
        $response = $this->gw->creditCardReturn($this->optsRetailSwiped([
            'TransactionAmount' => '100.01',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'TransactionID'     => $response->getTransactionId(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then void the return
        $response = $this->gw->creditCardVoid($this->optsRetailSwiped([
            'ReferenceNumber' => uniqid(),
            'TicketNumber'    => uniqid(),
            'TransactionID'   => $response->getTransactionId()
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Void of prior Return)',
            '100.01',
            $response->getCode(),
            $response->getTransactionId()
        ]);

    }

    public function testVisaPerformVoidOfPriorCredit()
    {
        // First create a credit to void
        $response = $this->gw->creditCardCredit($this->optsRetailSwiped([
            'TransactionAmount'       => '100.02',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then void the credit
        $response = $this->gw->creditCardVoid($this->optsRetailSwiped([
            'ReferenceNumber' => uniqid(),
            'TicketNumber'    => uniqid(),
            'TransactionID'   => $response->getTransactionId()
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Void of prior Credit)',
            '100.02',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }
}
