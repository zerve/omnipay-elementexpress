<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Mockery as m;
use Omnipay\ElementExpress\Message\AbstractRequest;
use Omnipay\ElementExpress\Model\CardTrait;

class MockCardTraitImplementation extends AbstractRequest
{
    use CardTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class CardTraitTest extends AbstractHasTraitTestCase
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
