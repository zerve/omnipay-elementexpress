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
class PaymentAccountQueryTest extends CertificationTestCase
{
    protected static $testDescription = 'Payment Account Query';

    public function testQueryByPaymentAccountId()
    {
        // Create a card token
        $response = $this->gw->paymentAccountCreate([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD,
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'           => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
            'BillingZipcode'                => '90210'
        ])->send();
        $this->assertSame("0", $response->getCode());

        // Query based on PaymentAccountID
        $response = $this->gw->paymentAccountQuery([
            'PaymentAccountID' => $response->getPaymentAccountId(),
        ])->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Query by PaymentAccountId',
            'N/A',
            $response->getCode(),
            $response->getData()->ServicesID
        ]);
    }

    public function testQueryByPaymentAccountReferenceNumber()
    {
        $ref = uniqid();

        // Create a card token
        $response = $this->gw->paymentAccountCreate([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD,
            'PaymentAccountReferenceNumber' => $ref,
            'CardDataKeySerialNumber'       => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'           => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
            'BillingZipcode'                => '90210'
        ])->send();
        $this->assertSame("0", $response->getCode());

        // Query based on PaymentAccountReferenceNumber
        $response = $this->gw->paymentAccountQuery([
            'PaymentAccountReferenceNumber' => $ref,
        ])->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Query by PaymentAccountReferenceNumber',
            'N/A',
            $response->getCode(),
            $response->getData()->ServicesID
        ]);
    }

    public function testQueryByPaymentBrand()
    {
        // Create a card token
        $response = $this->gw->paymentAccountCreate([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD,
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'           => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
            'BillingZipcode'                => '90210'
        ])->send();
        $this->assertSame("0", $response->getCode());

        // Query based on PaymentAccountReferenceNumber
        $response = $this->gw->paymentAccountQuery([
            'PaymentBrand' => 'Visa',
        ])->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Query by PaymentBrand',
            'N/A',
            $response->getCode(),
            $response->getData()->ServicesID
        ]);
    }

    public function testQueryByExpirationMonthAndYear()
    {
        // Create a card token
        $response = $this->gw->paymentAccountCreate([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD,
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'           => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
            'BillingZipcode'                => '90210'
        ])->send();
        $this->assertSame("0", $response->getCode());

        // Query based on PaymentAccountReferenceNumber
        $response = $this->gw->paymentAccountQuery([
            'ExpirationMonthEnd' => '12',
            'ExpirationYearEnd'  => '19',
        ])->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Query by ExpirationMonth and Year End',
            'N/A',
            $response->getCode(),
            $response->getData()->ServicesID
        ]);
    }
}
