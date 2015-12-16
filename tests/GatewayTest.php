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
    protected $creditCardSaleOptions       = [];
    protected $creditCardVoidOptions       = [];
    protected $paymentAccountCreateOptions = [];
    protected $creditCardReturnOptions     = [];
    protected $creditCardCreditOptions     = [];
    protected $creditCardReversalOptions   = [];

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        // Configure enough to pass validation.
        $this->creditCardSaleOptions       = ['TransactionAmount' => '10.00'];
        $this->paymentAccountCreateOptions = ['PaymentAccountType' => PaymentAccountType::CREDIT_CARD()];
        $this->creditCardReturnOptions        = ['TransactionAmount' => '10.00'];
        $this->creditCardCreditOptions        = ['TransactionAmount' => '10.00'];
    }

    /**
     * Omnipay\Tests\GatewayTestCase does not check whether the purchase()
     * method is supported before testing its parameters. Override the purchase
     * parameter method to perform the necessary test before proxying to the
     * parent class.
     */
    public function testPurchaseParameters()
    {
        if ($this->gateway->supportsPurchase()) {
            parent::testPurchaseParameters();
        }
    }

    public function testCreditCardSaleSuccess()
    {
        $this->setMockHttpResponse('CreditCardSaleSuccess.txt');
        $response = $this->gateway->creditCardSale($this->creditCardSaleOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testCreditCardSaleFailure()
    {
        $this->setMockHttpResponse('CreditCardSaleFailure.txt');
        $response = $this->gateway->creditCardSale($this->creditCardSaleOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testCreditCardSaleParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->creditCardSale();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testCreditCardVoidSuccess()
    {
        $this->setMockHttpResponse('CreditCardVoidSuccess.txt');
        $response = $this->gateway->creditCardVoid($this->creditCardVoidOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testCreditCardVoidFailure()
    {
        $this->setMockHttpResponse('CreditCardVoidFailure.txt');
        $response = $this->gateway->creditCardVoid($this->creditCardVoidOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testCreditCardVoidParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->creditCardVoid();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testPaymentAccountCreateSuccess()
    {
        $this->setMockHttpResponse('PaymentAccountCreateSuccess.txt');
        $response = $this->gateway->paymentAccountCreate($this->paymentAccountCreateOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testPaymentAccountCreateFailure()
    {
        $this->setMockHttpResponse('PaymentAccountCreateFailure.txt');
        $response = $this->gateway->paymentAccountCreate($this->paymentAccountCreateOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testPaymentAccountCreateParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->paymentAccountCreate();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testCreditCardReturnSuccess()
    {
        $this->setMockHttpResponse('CreditCardReturnSuccess.txt');
        $response = $this->gateway->creditCardReturn($this->creditCardReturnOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testCreditCardReturnFailure()
    {
        $this->setMockHttpResponse('CreditCardReturnFailure.txt');
        $response = $this->gateway->creditCardReturn($this->creditCardReturnOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testCreditCardReturnParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->creditCardReturn();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testCreditCardCreditSuccess()
    {
        $this->setMockHttpResponse('CreditCardCreditSuccess.txt');
        $response = $this->gateway->creditCardCredit($this->creditCardCreditOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testCreditCardCreditFailure()
    {
        $this->setMockHttpResponse('CreditCardCreditFailure.txt');
        $response = $this->gateway->creditCardCredit($this->creditCardCreditOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testCreditCardCreditParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->creditCardCredit();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testCreditCardReversalSuccess()
    {
        $this->setMockHttpResponse('CreditCardReversalSuccess.txt');
        $response = $this->gateway->creditCardReversal($this->creditCardReversalOptions)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testCreditCardReversalFailure()
    {
        $this->setMockHttpResponse('CreditCardReversalFailure.txt');
        $response = $this->gateway->creditCardReversal($this->creditCardReversalOptions)->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testCreditCardReversalParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->creditCardReversal();
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

    public function testPaymentAccountDeleteSuccess()
    {
        $this->setMockHttpResponse('PaymentAccountDeleteSuccess.txt');
        $response = $this->gateway->paymentAccountQuery()->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testPaymentAccountDeleteFailure()
    {
        $this->setMockHttpResponse('PaymentAccountDeleteFailure.txt');
        $response = $this->gateway->paymentAccountQuery()->send();
        $this->assertFalse($response->isSuccessful());
    }

    public function testPaymentAccountDeleteParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->paymentAccountDelete();
            $this->assertSame($value, $request->$getter());
        }
    }
}
