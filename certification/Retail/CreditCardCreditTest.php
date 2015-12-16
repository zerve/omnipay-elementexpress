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
        $response = $this->gw->creditCardCredit($this->optsRetailSwiped([
            'TransactionAmount'       => '5.20',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack1Data)',
            '5.20',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaSwipedEncryptedTrack2Data()
    {
        $response = $this->gw->creditCardCredit($this->optsRetailSwiped([
            'TransactionAmount'       => '5.21',
            'ReferenceNumber'         => uniqid(),
            'TicketNumber'            => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack2Data'     => getenv('VISA_ENCRYPTED_TRACK2_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack2Data)',
            '5.21',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaKeyedMagstripeFailureCardNumber()
    {
        $response = $this->gw->creditCardCredit($this->optsRetailKeyed([
            'TransactionAmount' => '5.26',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'CVVPresenceCode'   => CVVPresenceCode::PROVIDED,
            'CardNumber'      => getenv('VISA_CARD_NUMBER'),
            'ExpirationMonth' => getenv('VISA_EXPIRATION_MONTH'),
            'ExpirationYear'  => getenv('VISA_EXPIRATION_YEAR'),
            'CVV'             => rand(100, 999),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Keyed Magstripe Failure (CardNumber)',
            '5.26',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testVisaPaymentAccountId()
    {
        // First create a card token
        $response = $this->gw->paymentAccountCreate([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD,
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::FORMAT_4,
            'EncryptedTrack2Data'           => getenv('VISA_ENCRYPTED_TRACK2_DATA'),
        ])->send();
        $this->assertSame("0", $response->getCode());

        // Then credit the card using the token
        $response = $this->gw->creditCardCredit($this->optsRetailKeyed([
            'TransactionAmount' => '5.27',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'PaymentAccountID'  => $response->getPaymentAccountId(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Payment Account ID)',
            '5.27',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }
}
