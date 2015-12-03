<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\Tests\TestCase;
use Omnipay\ElementExpress\Gateway;

class ResponseTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        // Configure enough to pass validation.
        $this->voidOptions = [
            'transactionId' => '5660bee6cb946'
        ];

    }

    public function testResponseAccessors()
    {
        $this->setMockHttpResponse('VoidSuccess.txt');
        $response = $this->gateway->void($this->voidOptions)->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('2005849846', $response->getTransactionReference());
        $this->assertSame($this->voidOptions['transactionId'], $response->getTransactionId());
        $this->assertSame('Success', $response->getMessage());
        $this->assertSame('0', $response->getCode());
    }
}
