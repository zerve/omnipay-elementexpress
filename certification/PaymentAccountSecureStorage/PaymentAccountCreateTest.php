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

namespace Omnipay\ElementExpress\Certification\PaymentAccountSecureStorage;

use Omnipay\ElementExpress\Certification\CertificationTestCase;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;

/**
 * @group certification
 */
class PaymentAccountCreateTest extends CertificationTestCase
{
    protected static $testDescription = 'Payment Account Create';

    public function testVisaSwipedEncryptedTrack1Data()
    {
        $response = $this->gw->createCard([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD(),
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'           => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
            'card' => [
                'billingPostcode' => '90210'
            ]
        ])->send();
        $this->assertSame("0", $response->getCode());
        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack1Data)',
            'N/A',
            $response->getCode(),
            $response->getData()->ServicesID
        ]);
    }

    public function testVisaSwipedEncryptedTrack2Data()
    {
        $response = $this->gw->createCard([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD(),
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack2Data'           => getenv('VISA_ENCRYPTED_TRACK2_DATA'),
            'card' => [
                'billingPostcode' => '90210'
            ]
        ])->send();
        $this->assertSame("0", $response->getCode());
        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack2Data)',
            'N/A',
            $response->getCode(),
            $response->getData()->ServicesID
        ]);
    }

    public function testVisaKeyedCardNumber()
    {
        $response = $this->gw->createCard([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD(),
            'PaymentAccountReferenceNumber' => uniqid(),
            'card' => [
                'number'          => getenv('VISA_CARD_NUMBER'),
                'billingPostcode' => '90210',
                'expiryMonth'     => getenv('VISA_EXPIRATION_MONTH'),
                'expiryYear'      => getenv('VISA_EXPIRATION_YEAR'),
                'cvv'             => rand(100, 999),
            ]
        ])->send();
        $this->assertSame("0", $response->getCode());
        static::$buffer .= self::dataRow(...[
            'Visa Keyed (CardNumber)',
            'N/A',
            $response->getCode(),
            $response->getData()->ServicesID
        ]);
    }
}
