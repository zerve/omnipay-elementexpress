<?php
/**
 * Copyright 2015 Zerve, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Omnipay\ElementExpress\Tests;

use Omnipay\ElementExpress\Gateway;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    protected $purchaseOptions        = [];
    protected $voidOptions            = [];
    protected $createCardOptions      = [];
    protected $expressReturnOptions   = [];
    protected $expressCreditOptions   = [];
    protected $expressReversalOptions = [];

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        // Configure enough to pass validation.
        $this->purchaseOptions      = ['amount' => '10.00'];
        $this->createCardOptions    = ['PaymentAccountType' => PaymentAccountType::CREDIT_CARD()];
        $this->expressReturnOptions = ['amount' => '10.00'];
        $this->expressCreditOptions = ['amount' => '10.00'];
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

    public function testExpressCreditSuccess()
    {
        $this->setMockHttpResponse('ExpressCreditSuccess.txt');
        $response = $this->gateway->expressCredit($this->expressCreditOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testExpressCreditFailure()
    {
        $this->setMockHttpResponse('ExpressCreditFailure.txt');
        $response = $this->gateway->expressCredit($this->expressCreditOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testExpressCreditParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->expressCredit();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testExpressReversalSuccess()
    {
        $this->setMockHttpResponse('ExpressReversalSuccess.txt');
        $response = $this->gateway->expressReversal($this->expressReversalOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testExpressReversalFailure()
    {
        $this->setMockHttpResponse('ExpressReversalFailure.txt');
        $response = $this->gateway->expressReversal($this->expressReversalOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testExpressReversalParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->expressReversal();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testHealthCheckSuccess()
    {
        $this->setMockHttpResponse('HealthCheckSuccess.txt');
        $response = $this->gateway->healthCheck()->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testHealthCheckFailure()
    {
        $this->setMockHttpResponse('HealthCheckFailure.txt');
        $response = $this->gateway->healthCheck()->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testHealthCheckParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->healthCheck();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testPaymentAccountQuerySuccess()
    {
        $this->setMockHttpResponse('PaymentAccountQuerySuccess.txt');
        $response = $this->gateway->paymentAccountQuery()->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testPaymentAccountQueryFailure()
    {
        $this->setMockHttpResponse('PaymentAccountQueryFailure.txt');
        $response = $this->gateway->paymentAccountQuery()->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testPaymentAccountQueryParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->paymentAccountQuery();
            $this->assertSame($value, $request->$getter());
        }
    }


}
