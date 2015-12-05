<?php
namespace Omnipay\ElementExpress\Tests;

use Mockery as m;
use Omnipay\ElementExpress\HasPaymentAccountTrait;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\ElementExpress\Message\AbstractRequest;

class MockPaymentAccountTraitImplementation extends AbstractRequest
{
    use HasPaymentAccountTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class HasPaymentAccountTraitTest extends AbstractHasTraitTestCase
{
    public function getMockRequest()
    {
        $client  = m::mock('Guzzle\Http\Client');
        $request = m::mock('Symfony\Component\HttpFoundation\Request');
        if (null === $this->mockRequest) {
            $this->mockRequest = new MockPaymentAccountTraitImplementation($client, $request);
        }
        return $this->mockRequest;
    }

    public function getMockModel()
    {
        if (null === $this->mockModel) {
            $request = $this->getMockRequest();
            $this->mockModel = $request->getPaymentAccount()->initialize([
                'PaymentAccountType' => PaymentAccountType::CREDIT_CARD()
            ]);
        }
        return $this->mockModel;
    }
}
