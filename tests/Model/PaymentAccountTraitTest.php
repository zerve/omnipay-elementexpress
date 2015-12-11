<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Mockery as m;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\ElementExpress\Message\AbstractRequest;
use Omnipay\ElementExpress\Model\PaymentAccountTrait;

class MockPaymentAccountTraitImplementation extends AbstractRequest
{
    use PaymentAccountTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class PaymentAccountTraitTest extends AbstractTraitTestCase
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
            $this->mockModel = $request->getPaymentAccountModel()->initialize([
                'PaymentAccountType' => PaymentAccountType::CREDIT_CARD()
            ]);
        }
        return $this->mockModel;
    }
}
