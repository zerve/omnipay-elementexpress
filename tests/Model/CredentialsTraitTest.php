<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Mockery as m;
use Omnipay\ElementExpress\Message\AbstractRequest;
use Omnipay\ElementExpress\Model\CredentialsTrait;

class MockCredentialsTraitImplementation extends AbstractRequest
{
    use CredentialsTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class CredentialsTraitTest extends AbstractHasTraitTestCase
{
    public function getMockRequest()
    {
        $client  = m::mock('Guzzle\Http\Client');
        $request = m::mock('Symfony\Component\HttpFoundation\Request');
        if (null === $this->mockRequest) {
            $this->mockRequest = new MockCredentialsTraitImplementation($client, $request);
        }
        return $this->mockRequest;
    }

    public function getMockModel()
    {
        if (null === $this->mockModel) {
            $request = $this->getMockRequest();
            $this->mockModel = $request->getCredentialsModel();
        }
        return $this->mockModel;
    }
}
