<?php
namespace Omnipay\ElementExpress\Tests\Message;

use Mockery as m;
use Omnipay\ElementExpress\Message\AbstractRequest;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    /**
     * @expectedException UnexpectedValueException
     */
    public function testGetModelsThrowsExceptionOnInvalidSubclass()
    {
        $request = m::mock('Omnipay\ElementExpress\Message\AbstractRequest')->makePartial();
        $request->shouldReceive('getApplicationModel')->andReturn(new \stdClass());
        $request->shouldReceive('getCredentialsModel')->andReturn(new \stdClass());
        $request->getModels();
    }
}
