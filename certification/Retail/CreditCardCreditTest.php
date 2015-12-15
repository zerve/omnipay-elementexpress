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
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;

/**
 * @group certification
 */
class CreditCardCreditTest extends CertificationTestCase
{
    protected static $testDescription = 'Credit Card Credit';

    public function testVisaSwipedEncryptedTrack1Data()
    {
        $response = $this->gw->expressCredit($this->optsRetailSwiped([
            'amount'                  => '5.20',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack1Data)',
            '5.20',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaSwipedEncryptedTrack2Data()
    {
        $response = $this->gw->expressCredit($this->optsRetailSwiped([
            'amount'                  => '5.21',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack2Data'     => getenv('VISA_ENCRYPTED_TRACK2_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack2Data)',
            '5.21',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaKeyedMagstripeFailureCardNumber()
    {
        $response = $this->gw->expressCredit($this->optsRetailKeyed([
            'amount'          => '5.26',
            'transactionId'   => uniqid(),
            'CVVPresenceCode' => CVVPresenceCode::PROVIDED(),
            'card'            => [
                'number'          => getenv('VISA_CARD_NUMBER'),
                'expiryMonth'     => getenv('VISA_EXPIRATION_MONTH'),
                'expiryYear'      => getenv('VISA_EXPIRATION_YEAR'),
                'cvv'             => rand(100, 999),
            ]
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Keyed Magstripe Failure (CardNumber)',
            '5.26',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaPaymentAccountId()
    {
        // First create a card token
        $response = $this->gw->createCard([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD(),
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::FORMAT_4(),
            'EncryptedTrack2Data'           => getenv('VISA_ENCRYPTED_TRACK2_DATA'),
        ])->send();
        $this->assertSame("0", $response->getCode());

        // Then credit the card using the token
        $response = $this->gw->expressCredit($this->optsRetailSwiped([
            'amount'        => '5.27',
            'transactionId' => uniqid(),
            'cardReference' => $response->getCardReference(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Payment Account ID)',
            '5.27',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }
}
