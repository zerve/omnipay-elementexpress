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
    protected static $testDescription = 'Payment Account Usage';

    public function testCreditCardSaleVisaOneTime()
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

        // Perform a CreditCardSale with the token
        $response = $this->gw->creditCardSale($this->optsRetailKeyed([
            'TransactionAmount' => '1.81',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'PaymentAccountID'  => $response->getPaymentAccountId(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'CreditCardSale (Visa-one time)',
            '1.81',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testCreditCardSaleMastercardOneTime()
    {
        // Create a card token
        $response = $this->gw->paymentAccountCreate([
            'PaymentAccountType'            => PaymentAccountType::CREDIT_CARD,
            'PaymentAccountReferenceNumber' => uniqid(),
            'CardDataKeySerialNumber'       => getenv('MASTERCARD_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT'))->value(),
            'EncryptedTrack1Data'           => getenv('MASTERCARD_ENCRYPTED_TRACK1_DATA'),
            'BillingZipcode'                => '90210'
        ])->send();
        $this->assertSame("0", $response->getCode());

        // Perform a CreditCardSale with the token
        $response = $this->gw->creditCardSale($this->optsRetailKeyed([
            'TransactionAmount' => '1.82',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'PaymentAccountID'  => $response->getPaymentAccountId(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'CreditCardSale (MasterCard-one time)',
            '1.82',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testCreditCardReversalVisa()
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

        $paymentAccountId = $response->getPaymentAccountId();

        // Create a CreditCardSale to reverse.
        $response = $this->gw->creditCardSale($this->optsRetailKeyed([
            'TransactionAmount' => '1.85',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'PaymentAccountID'  => $paymentAccountId,
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Reverse the CreditCardSale
        $response = $this->gw->creditCardReversal($this->optsRetailKeyed([
            'TransactionAmount' => '1.85',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'ReversalType'      => ReversalType::SYSTEM,
            'PaymentAccountID'  => $paymentAccountId,
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'CreditCardReversal (Visa)',
            '1.85',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }

    public function testCreditCardCreditVisa()
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

        $paymentAccountId = $response->getPaymentAccountId();

        // Create a CreditCardSale to credit.
        $response = $this->gw->creditCardSale($this->optsRetailKeyed([
            'TransactionAmount' => '1.93',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'PaymentAccountID'  => $paymentAccountId,
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Credit the CreditCardSale amount back to the card
        $response = $this->gw->creditCardCredit($this->optsRetailKeyed([
            'TransactionAmount' => '1.93',
            'ReferenceNumber'   => uniqid(),
            'TicketNumber'      => uniqid(),
            'PaymentAccountID'  => $paymentAccountId,
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'CreditCardCredit (Visa)',
            '1.93',
            $response->getCode(),
            $response->getTransactionId()
        ]);
    }
}
