<?php
namespace Omnipay\ElementExpressTests;

use Mockery as m;
use Omnipay\ElementExpress\HasTransactionTrait;
use Omnipay\ElementExpress\Message\AbstractRequest;
use Omnipay\Tests\TestCase;

class MockTransactionTraitImplementation extends AbstractRequest
{
    use HasTransactionTrait;
    public function getData() {}
    protected function getEndpoint() {}
    protected function getXmlNamespace() {}
}

class HasTransactionTraitTest extends TestCase
{
    protected $mockRequest;

    public function getMockRequest()
    {
        if (null === $this->mockRequest) {
            $this->mockRequest = new MockTransactionTraitImplementation(
                $this->getHttpClient(), $this->getHttpRequest());
        }
        return $this->mockRequest;
    }

    public function parameterDataProvider()
    {
        $request  = $this->getMockRequest();
        $settings = $request->getTransaction()->getDefaultParameters();
        foreach ($settings as $key => $default) {
            $setter = 'set' . ucfirst($key);
            $getter = 'get' . ucfirst($key);
            $value  = $default ?: uniqid();
            yield [$setter, $getter, $value];
        }
    }

    /**
     * @dataProvider parameterDataProvider
     */
    public function testParameterAccessors($setter, $getter, $value)
    {
        $request = $this->getMockRequest();
        $this->assertTrue(method_exists($request, $setter), "Trait must implement $setter()");
        $this->assertTrue(method_exists($request, $getter), "Trait must implement $getter()");

        // Setter must provide fluent interface.
        $this->assertSame($request, $request->$setter($value));
        $this->assertSame($value, $request->$getter());
    }
}
