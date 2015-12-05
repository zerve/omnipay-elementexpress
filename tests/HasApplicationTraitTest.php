<?php
namespace Omnipay\ElementExpress\Tests;

use Mockery as m;
use Omnipay\ElementExpress\HasApplicationTrait;
use Omnipay\ElementExpress\Message\AbstractRequest;

class MockApplicationTraitImplementation extends AbstractRequest
{
    use HasApplicationTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class HasApplicationTraitTest extends AbstractHasTraitTestCase
{
    public function getMockRequest()
    {
        $client  = m::mock('Guzzle\Http\Client');
        $request = m::mock('Symfony\Component\HttpFoundation\Request');
        if (null === $this->mockRequest) {
            $this->mockRequest = new MockApplicationTraitImplementation($client, $request);
        }
        return $this->mockRequest;
    }

    public function getMockModel()
    {
        if (null === $this->mockModel) {
            $request = $this->getMockRequest();
            $this->mockModel = $request->getApplication();
        }
        return $this->mockModel;
    }
}
