<?php
namespace Omnipay\ElementExpress\Certification\Retail;

use Omnipay\ElementExpress\Certification\CertificationTestCase;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;

/**
 * @group certification
 */
class CreditCardVoidTest extends CertificationTestCase
{
    protected static $testDescription = 'Credit Card Void';

    public function testVisaPerformVoidOfPriorSale()
    {
        // First create a sale to void.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '100.00',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then void the sale
        $response = $this->gw->void($this->optsRetailSwiped([
            'transactionId'        => uniqid(),
            'transactionReference' => $response->getTransactionReference()
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Void of prior Sale)',
            '100.00',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaPerformVoidOfPriorReturn()
    {
        // First create a sale.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '100.01',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Perform a full return on the previous sale.
        $response = $this->gw->expressReturn($this->optsRetailSwiped([
            'amount'                  => '100.01',
            'transactionId'           => uniqid(),
            'transactionReference'    => $response->getTransactionReference(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then void the return
        $response = $this->gw->void($this->optsRetailSwiped([
            'transactionId'        => uniqid(),
            'transactionReference' => $response->getTransactionReference()
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Void of prior Return)',
            '100.01',
            $response->getCode(),
            $response->getTransactionReference()
        ]);

    }

    public function testVisaPerformVoidOfPriorCredit()
    {
        // First create a credit to void
        $response = $this->gw->expressCredit($this->optsRetailSwiped([
            'amount'                  => '100.02',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then void the credit
        $response = $this->gw->void($this->optsRetailSwiped([
            'transactionId'        => uniqid(),
            'transactionReference' => $response->getTransactionReference()
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Void of prior Credit)',
            '100.02',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }
}
