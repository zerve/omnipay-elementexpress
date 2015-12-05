<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Mockery as m;
use Omnipay\ElementExpress\Model\ModelAbstract;
use Omnipay\ElementExpress\Model\Card;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;
use PHPUnit_Framework_TestCase;

class CardTest extends PHPUnit_Framework_TestCase
{
    public function testConditionalEncryptionParametersPresent()
    {
        $data = [
            'EncryptedTrack1Data'     => uniqid(),
            'EncryptedFormat'         => EncryptedFormat::__DEFAULT(),
            'CardDataKeySerialNumber' => uniqid(),
        ];

        $doc   = new \DOMDocument('1.0');
        $model = new Card();
        $model->initialize($data)->appendToDom($doc);

        $this->assertSame(1, $doc->getElementsByTagName('EncryptedFormat')->length,
            'Did not find expected "EncryptedFormat" node');
        $this->assertSame(1, $doc->getElementsByTagName('CardDataKeySerialNumber')->length,
            'Did not find expected "CardDataKeySerialNumber" node');
    }

    public function testConditionalEncryptionParametersAbsent()
    {
        $data = [
            'number'                  => uniqid(),
            'EncryptedFormat'         => EncryptedFormat::__DEFAULT(),
            'CardDataKeySerialNumber' => uniqid(),
        ];

        $doc   = new \DOMDocument('1.0');
        $model = new Card();
        $model->initialize($data)->appendToDom($doc);

        $this->assertSame(0, $doc->getElementsByTagName('EncryptedFormat')->length,
            'Found unexpected "EncryptedFormat" node');
        $this->assertSame(0, $doc->getElementsByTagName('CardDataKeySerialNumber')->length,
            'Found unexpected "EncryptedFormat" node');
    }

    public function testCardFieldGroupPrecedence()
    {
        // Data needed to initialize card model.
        $data = [
            'MagneprintData'      => uniqid(),
            'EncryptedTrack2Data' => uniqid(),
            'EncryptedTrack1Data' => uniqid(),
            'EncryptedCardData'   => uniqid(),
            'Track2Data'          => uniqid(),
            'Track1Data'          => uniqid(),
            'number'              => '4111111111111111',
            'expiryMonth'         => '01',
            'expiryYear'          => gmdate('Y') + 2,
        ];

        // Fields to look for in precedence order.
        $fields = [
            'MagneprintData',
            'EncryptedTrack2Data',
            'EncryptedTrack1Data',
            'EncryptedCardData',
            'Track2Data',
            'Track1Data',
            'CardNumber',
        ];

        while ($fields) {

            $doc   = new \DOMDocument('1.0');
            $model = new Card();
            $model->initialize($data)->appendToDom($doc);

            $this->assertSame(1, $doc->getElementsByTagName(current($fields))->length,
                'Did not find expected "' . current($fields) . '" node');

            // Remove highest precedence element
            array_shift($fields);
            array_shift($data);

        }
    }
}
