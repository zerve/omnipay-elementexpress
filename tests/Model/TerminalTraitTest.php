<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Mockery as m;
use Omnipay\ElementExpress\Model\TerminalTrait;
use Omnipay\ElementExpress\Message\AbstractRequest;

class MockTerminalTraitImplementation extends AbstractRequest
{
    use TerminalTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class TerminalTraitTest extends AbstractHasTraitTestCase
{
    public function getMockRequest()
    {
        $client  = m::mock('Guzzle\Http\Client');
        $request = m::mock('Symfony\Component\HttpFoundation\Request');
        if (null === $this->mockRequest) {
            $this->mockRequest = new MockTerminalTraitImplementation($client, $request);
        }
        return $this->mockRequest;
    }

    public function getMockModel()
    {
        if (null === $this->mockModel) {
            $request = $this->getMockRequest();
            $this->mockModel = $request->getTerminalModel();
        }
        return $this->mockModel;
    }
}
