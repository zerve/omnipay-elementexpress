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
class CreditCardReturnTest extends CertificationTestCase
{
    protected static $testDescription = 'Credit Card Return';

    public function testVisaFullCreditCardReturn()
    {
        // First create a sale.
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '3.20',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Sale)',
            '3.20',
            $response->getCode(),
            $response->getTransactionId()
        ]);

        // Perform a full return on the previous sale.
        $response = $this->gw->creditCardReturn($this->optsRetailSwiped([
            'TransactionAmount' => '3.20',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'TransactionID'     => $response->getTransactionId(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (full CreditCardReturn)',
            '3.20',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaPartialCreditCardReturn()
    {
        // First create a sale.
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '3.25',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Sale)',
            '3.25',
            $response->getCode(),
            $response->getTransactionId()
        ]);

        // Perform a full return on the previous sale.
        $response = $this->gw->creditCardReturn($this->optsRetailSwiped([
            'TransactionAmount' => '2.25',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'TransactionID'     => $response->getTransactionId(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (partial CreditCardReturn)',
            '2.25',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }
}
