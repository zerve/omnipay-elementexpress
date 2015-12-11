<?php
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
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
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
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack2Data'     => getenv('ENCRYPTED_TRACK2_DATA'),
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
                'number'          => getenv('CARD_NUMBER'),
                'expiryMonth'     => getenv('EXPIRATION_MONTH'),
                'expiryYear'      => getenv('EXPIRATION_YEAR'),
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
            'CardDataKeySerialNumber'       => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'               => EncryptedFormat::FORMAT_4(),
            'EncryptedTrack2Data'           => getenv('ENCRYPTED_TRACK2_DATA'),
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
