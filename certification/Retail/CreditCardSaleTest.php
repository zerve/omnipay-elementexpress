<?php
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
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '2.04',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack1Data)',
            '2.04',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaSwipedEncryptedTrack2Data()
    {
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '2.05',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack2Data'     => getenv('ENCRYPTED_TRACK2_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Swiped (EncryptedTrack2Data)',
            '2.05',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaKeyedMagstripeFailureCardNumber()
    {
        $response = $this->gw->purchase($this->optsRetailKeyed([
            'amount'          => '2.10',
            'transactionId'   => uniqid(),
            'CVVPresenceCode' => CVVPresenceCode::PROVIDED(),
            'card'            => [
                'number'          => getenv('CARD_NUMBER'),
                'billingPostcode' => '90210',
                'expiryMonth'     => getenv('EXPIRATION_MONTH'),
                'expiryYear'      => getenv('EXPIRATION_YEAR'),
                'cvv'             => rand(100, 999),
            ]
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa Keyed Magstripe Failure (CardNumber)',
            '2.10',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaPartialApproved()
    {
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '23.05',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("5", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Partial Approved)',
            '23.05',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaBalanceAndCurrencyCode()
    {
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '23.06',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Balance and Currency Code)',
            '23.06',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

}
