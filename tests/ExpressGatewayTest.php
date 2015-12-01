<?php

namespace Omnipay\Vantiv;

use Omnipay\Tests\GatewayTestCase;

class ExpressGatewayTest extends GatewayTestCase
{
    protected $purchaseOptions = [];
    protected $refundOptions = [];

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new ExpressGateway($this->getHttpClient(), $this->getHttpRequest());

        // Configure enough to pass validation.
        $this->purchaseOptions = array(
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        );

        // Configure enough to pass validation.
        $this->refundOptions = array(
            'amount' => '10.00'
        );
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('ExpressPurchaseSuccess.txt');
        $response = $this->gateway->purchase($this->purchaseOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('ExpressPurchaseFailure.txt');
        $response = $this->gateway->purchase($this->purchaseOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testRefundSuccess()
    {
        $this->setMockHttpResponse('ExpressRefundSuccess.txt');
        $response = $this->gateway->refund($this->refundOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testRefundFailure()
    {
        $this->setMockHttpResponse('ExpressRefundFailure.txt');
        $response = $this->gateway->refund($this->refundOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }
}
