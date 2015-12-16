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
use Omnipay\ElementExpress\Enumeration\CVVPresenceCode;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;

/**
 * @group certification
 */
class CreditCardSaleTest extends CertificationTestCase
{
    protected static $testDescription = 'Credit Card Sale';

    public function testVisaSwipedEncryptedTrack1Data()
    {
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '2.04',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack1Data)',
            '2.04',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaSwipedEncryptedTrack2Data()
    {
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '2.05',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack2Data'     => getenv('VISA_ENCRYPTED_TRACK2_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack2Data)',
            '2.05',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaKeyedMagstripeFailureCardNumber()
    {
        $response = $this->gw->creditCardSale($this->optsRetailKeyed([
            'TransactionAmount' => '2.10',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'CVVPresenceCode'   => CVVPresenceCode::PROVIDED,
            'card'              => [
                'CardNumber'      => getenv('VISA_CARD_NUMBER'),
                'BillingZipZode'  => '90210',
                'ExpirationMonth' => getenv('VISA_EXPIRATION_MONTH'),
                'ExpirationYear'  => getenv('VISA_EXPIRATION_YEAR'),
                'CVV'             => rand(100, 999),
            ]
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Keyed Magstripe Failure (CardNumber)',
            '2.10',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaPartialApproved()
    {
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '23.05',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("5", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Partial Approved)',
            '23.05',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaBalanceAndCurrencyCode()
    {
        $response = $this->gw->creditCardSale($this->optsRetailSwiped([
            'TransactionAmount'       => '23.06',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Balance and Currency Code)',
            '23.06',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

}
