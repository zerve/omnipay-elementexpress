<?php
namespace Omnipay\ElementExpress\Certification\Retail;

use Omnipay\ElementExpress\Certification\CertificationTestCase;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;
use Omnipay\ElementExpress\Enumeration\ReversalType;

/**
 * @group certification
 */
class DuplicateOverrideTest extends CertificationTestCase
{
    protected static $testDescription = 'Overriding Duplicates';

    public function testVisaOverrideDuplicateSale()
    {
        // First create a sale.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '0.23',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("23", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Sale)',
            '0.23',
            $response->getCode(),
            $response->getTransactionReference()
        ]);

        // Run it again with duplicate override set to true.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '0.23',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
            'DuplicateOverrideFlag'   => "1",
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Sale, DuplicateOverride=true)',
            '0.23',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }

    public function testVisaDuplicateCheckDisabled()
    {
        // First create a sale.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                  => '0.23',
            'transactionId'           => uniqid(),
            'CardDataKeySerialNumber' => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'         => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'     => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
        ]))->send();
        $this->assertSame("23", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Sale)',
            '0.23',
            $response->getCode(),
            $response->getTransactionReference()
        ]);

        // Run it again with duplicate checks disabled set to true.
        $response = $this->gw->purchase($this->optsRetailSwiped([
            'amount'                    => '0.23',
            'transactionId'             => uniqid(),
            'CardDataKeySerialNumber'   => getenv('VISA_CARD_DATA_KEY_SERIAL_NUMBER'),
            'EncryptedFormat'           => EncryptedFormat::memberByKey(getenv('ENCRYPTED_FORMAT')),
            'EncryptedTrack1Data'       => getenv('VISA_ENCRYPTED_TRACK1_DATA'),
            'DuplicateCheckDisableFlag' => "1",
        ]))->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'Visa (Sale, DuplicateCheckDisableFlag=true)',
            '0.23',
            $response->getCode(),
            $response->getTransactionReference()
        ]);
    }
}
