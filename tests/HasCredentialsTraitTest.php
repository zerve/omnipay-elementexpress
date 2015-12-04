<?php
namespace Omnipay\ElementExpress;

use Mockery as m;
use Omnipay\ElementExpress\Message\AbstractRequest;
use Omnipay\Tests\TestCase;

class MockCredentialsTraitImplementation extends AbstractRequest
{
    use HasCredentialsTrait;
    public function getData() {}
}

class HasCredentialsTraitTest extends TestCase
{
    protected $mockRequest;

    public function getMockRequest()
    {
        if (null === $this->mockRequest) {
            $this->mockRequest = new MockCredentialsTraitImplementation(
                $this->getHttpClient(), $this->getHttpRequest());
        }
        return $this->mockRequest;
    }

    public function parameterDataProvider()
    {
        $request  = $this->getMockRequest();
        $settings = $request->getCredentials()->getDefaultParameters();
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
