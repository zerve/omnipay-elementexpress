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

use Omnipay\ElementExpress\Enumeration\EncryptedFormat;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\ElementExpress\Enumeration\ReversalType;
use Omnipay\ElementExpress\Certification\CertificationTestCase;

/**
 * @group certification
 */
class TransactionsWithPaymentAccountIdTest extends CertificationTestCase
{
    protected static $testDescription = 'Payment Account Create';

    public function testCreditCardSaleVisaOneTime()
    {
        // Create a card token
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

        // Perform a CreditCardSale with the token
        $response = $this->gw->purchase($this->optsRetailKeyed([
            'amount'        => '1.81',
            'transactionId' => uniqid(),
            'cardReference' => $response->getCardReference(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'CreditCardSale (Visa-one time)',
            '1.81',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testCreditCardSaleMastercardOneTime()
    {
        // Create a card token
        $response = $this->gw->createCard([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD(),
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('MASTERCARD_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'           => getenv('MASTERCARD_ENCRYPTED_TRACK1_DATA'),
            'card' => [
                'billingPostcode' => '90210'
            ]
        ])->send();
        $this->assertSame("0", $response->getCode());

        // Perform a CreditCardSale with the token
        $response = $this->gw->purchase($this->optsRetailKeyed([
            'amount'        => '1.82',
            'transactionId' => uniqid(),
            'cardReference' => $response->getCardReference(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'CreditCardSale (MasterCard-one time)',
            '1.82',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testCreditCardReversalVisa()
    {
        // Create a card token
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

        $cardReference = $response->getCardReference();

        // Create a CreditCardSale to reverse.
        $response = $this->gw->purchase($this->optsRetailKeyed([
            'amount'        => '1.85',
            'transactionId' => uniqid(),
            'cardReference' => $cardReference,
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Reverse the CreditCardSale
        $response = $this->gw->expressReversal($this->optsRetailKeyed([
            'amount'        => '1.85',
            'transactionId' => uniqid(),
            'ReversalType'  => ReversalType::SYSTEM(),
            'cardReference' => $cardReference,
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'CreditCardReversal (Visa)',
            '1.85',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testCreditCardCreditVisa()
    {
        // Create a card token
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

        $cardReference = $response->getCardReference();

        // Create a CreditCardSale to credit.
        $response = $this->gw->purchase($this->optsRetailKeyed([
            'amount'        => '1.93',
            'transactionId' => uniqid(),
            'cardReference' => $cardReference,
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Credit the CreditCardSale amount back to the card
        $response = $this->gw->expressCredit($this->optsRetailKeyed([
            'amount'        => '1.93',
            'transactionId' => uniqid(),
            'cardReference' => $cardReference,
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'CreditCardCredit (Visa)',
            '1.93',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }
}
