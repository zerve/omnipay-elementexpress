<?php
namespace Omnipay\ElementExpress\Tests;

use Mockery as m;
use Omnipay\ElementExpress\HasTerminalTrait;
use Omnipay\ElementExpress\Message\AbstractRequest;

class MockTerminalTraitImplementation extends AbstractRequest
{
    use HasTerminalTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class HasTerminalTraitTest extends AbstractHasTraitTestCase
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
            $this->mockModel = $request->getTerminal();
        }
        return $this->mockModel;
    }
}
