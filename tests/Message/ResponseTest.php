<?php
namespace Omnipay\ElementExpress\Tests\Message;

use Mockery as m;
use Omnipay\ElementExpress\Gateway;
use Omnipay\ElementExpress\Message\Response;
use Omnipay\Tests\TestCase;

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

    /**
     * @expectedException Omnipay\Common\Exception\InvalidResponseException
     */
    public function testConstructorThrowsInvalidResponseException()
    {
        $request = m::mock('Omnipay\Common\Message\RequestInterface');
        $model   = new Response($request, null);
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
