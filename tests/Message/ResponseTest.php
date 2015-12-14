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
            'transactionId' => '566f2ecb0780c'
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
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->gateway->void($this->voidOptions)->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('2005890590', $response->getTransactionReference());
        $this->assertSame($this->voidOptions['transactionId'], $response->getTransactionId());
        $this->assertSame('Approved', $response->getMessage());
        $this->assertSame('0', $response->getCode());
        $this->assertSame('000004', $response->getApprovalNumber());
        $this->assertSame('N', $response->getAvsResponse());
        $this->assertSame('8F07972A-C442-4B49-838D-BFD73CCEEF7B', $response->getCustomerToken());
    }
}
