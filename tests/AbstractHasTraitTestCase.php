<?php
namespace Omnipay\ElementExpress\Tests;

use Omnipay\Tests\TestCase;

abstract class AbstractHasTraitTestCase extends \PHPUnit_Framework_TestCase
{
    protected $mockRequest;
    protected $mockModel;

    abstract public function getMockRequest();
    abstract public function getMockModel();

    public function parameterDataProvider()
    {
        $model = $this->getMockModel();
        foreach ($model->toArray() as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $getter = 'get' . ucfirst($key);
            $value = $value ?: uniqid();
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
