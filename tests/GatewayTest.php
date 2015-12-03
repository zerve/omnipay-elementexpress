<?php

namespace Omnipay\ElementExpress;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    protected $purchaseOptions = [];
    protected $refundOptions = [];

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        // Configure enough to pass validation.
        $this->purchaseOptions = array(
            'amount'        => '10.00',
            'card'          => $this->getValidCard(),
            'transactionId' => '5660701c2cc39'
        );

        // Configure enough to pass validation.
        $this->refundOptions = array(
            'amount'        => '10.00',
            'transactionId' => '566073022feca'
        );
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->gateway->purchase($this->purchaseOptions)->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('2005846437', $response->getTransactionReference());
        $this->assertSame($this->purchaseOptions['transactionId'], $response->getTransactionId());
        $this->assertSame('Approved', $response->getMessage());
        $this->assertSame('0', $response->getCode());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->gateway->purchase($this->purchaseOptions)->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('2005846500', $response->getTransactionReference());
        $this->assertSame($this->purchaseOptions['transactionId'], $response->getTransactionId());
        $this->assertSame('Declined', $response->getMessage());
        $this->assertSame('20', $response->getCode());
    }

    public function testRefundSuccess()
    {
        $this->setMockHttpResponse('RefundSuccess.txt');
        $response = $this->gateway->refund($this->refundOptions)->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('2005846634', $response->getTransactionReference());
        $this->assertSame($this->refundOptions['transactionId'], $response->getTransactionId());
        $this->assertSame('Approved', $response->getMessage());
        $this->assertSame('0', $response->getCode());
    }

    public function testRefundFailure()
    {
        $this->setMockHttpResponse('RefundFailure.txt');
        $response = $this->gateway->refund($this->refundOptions)->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('2005846625', $response->getTransactionReference());
        $this->assertSame($this->refundOptions['transactionId'], $response->getTransactionId());
        $this->assertSame('Declined', $response->getMessage());
        $this->assertSame('20', $response->getCode());
    }
}
