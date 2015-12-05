<?php
namespace Omnipay\ElementExpress\Tests;

use Mockery as m;
use Omnipay\ElementExpress\HasCardTrait;
use Omnipay\ElementExpress\Message\AbstractRequest;

class MockCardTraitImplementation extends AbstractRequest
{
    use HasCardTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class HasCardTraitTest extends AbstractHasTraitTestCase
{
    public function getMockRequest()
    {
        $client  = m::mock('Guzzle\Http\Client');
        $request = m::mock('Symfony\Component\HttpFoundation\Request');
        if (null === $this->mockRequest) {
            $this->mockRequest = new MockCardTraitImplementation($client, $request);
        }
        return $this->mockRequest;
    }

    public function getMockModel()
    {
        if (null === $this->mockModel) {
            $request = $this->getMockRequest();
            $this->mockModel = $request->getCard();
        }
        return $this->mockModel;
    }
}
