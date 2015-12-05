<?php
namespace Omnipay\ElementExpress\Tests;

use Omnipay\ElementExpress\Gateway;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    protected $purchaseOptions      = [];
    protected $voidOptions          = [];
    protected $createCardOptions    = [];
    protected $expressReturnOptions = [];

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        // Configure enough to pass validation.
        $this->purchaseOptions      = ['amount' => '10.00'];
        $this->createCardOptions    = ['PaymentAccountType' => PaymentAccountType::CREDIT_CARD()];
        $this->expressReturnOptions = ['amount' => '10.00'];
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->gateway->purchase($this->purchaseOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->gateway->purchase($this->purchaseOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testVoidSuccess()
    {
        $this->setMockHttpResponse('VoidSuccess.txt');
        $response = $this->gateway->void($this->voidOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testVoidFailure()
    {
        $this->setMockHttpResponse('VoidFailure.txt');
        $response = $this->gateway->void($this->voidOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testCreateCardSuccess()
    {
        $this->setMockHttpResponse('CreateCardSuccess.txt');
        $response = $this->gateway->createCard($this->createCardOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testCreateCardFailure()
    {
        $this->setMockHttpResponse('CreateCardFailure.txt');
        $response = $this->gateway->createCard($this->createCardOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testExpressReturnSuccess()
    {
        $this->setMockHttpResponse('ExpressReturnSuccess.txt');
        $response = $this->gateway->expressReturn($this->expressReturnOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testExpressReturnFailure()
    {
        $this->setMockHttpResponse('ExpressReturnFailure.txt');
        $response = $this->gateway->expressReturn($this->expressReturnOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testExpressReturnParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->expressReturn();
            $this->assertSame($value, $request->$getter());
        }
    }
}
