<?php
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
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '3.20',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Sale)',
            '3.20',
            $response->getCode(),
            $response->getTransactionReference()
        ]);

        // Perform a full return on the previous sale.
        $response = $this->gw->expressReturn($this->optsRetailSwiped([
            'amount'                  => '3.20',
            'transactionId'           => uniqid(),
            'transactionReference'    => $response->getTransactionReference(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (full CreditCardReturn)',
            '3.20',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaPartialCreditCardReturn()
    {
        // First create a sale.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '3.25',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Sale)',
            '3.25',
            $response->getCode(),
            $response->getTransactionReference()
        ]);

        // Perform a full return on the previous sale.
        $response = $this->gw->expressReturn($this->optsRetailSwiped([
            'amount'                  => '2.25',
            'transactionId'           => uniqid(),
            'transactionReference'    => $response->getTransactionReference(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (partial CreditCardReturn)',
            '2.25',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }
}
