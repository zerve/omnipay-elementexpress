<?php
namespace Omnipay\ElementExpress\Certification\Retail;

use Omnipay\ElementExpress\Certification\CertificationTestCase;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;
use Omnipay\ElementExpress\Enumeration\ReversalType;

/**
 * @group certification
 */
class CreditCardReversalTest extends CertificationTestCase
{
    protected static $testDescription = 'Credit Card Reversal';

    public function testVisaPerformSystemReversalOfPriorSale()
    {
        // First create a sale to reverse.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '200.00',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then reverse the sale
        $response = $this->gw->expressReversal($this->optsRetailSwiped([
            'amount'                  => '200.00',
            'transactionId'           => uniqid(),
            'ReversalType'            => ReversalType::SYSTEM(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform System Reversal of prior Sale)',
            '200.00',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaPerformFullReversalOfPriorSale()
    {
        // First create a sale to reverse.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '200.01',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        // Then reverse the sale
        $response = $this->gw->expressReversal($this->optsRetailSwiped([
            'amount'                  => '200.01',
            'transactionId'           => uniqid(),
            'transactionReference'    => $response->getTransactionReference(),
            'ReversalType'            => ReversalType::FULL(),
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (perform Full Reversal of prior Sale)',
            '200.01',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }
}
