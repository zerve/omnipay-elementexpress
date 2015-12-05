<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Mockery as m;
use Omnipay\ElementExpress\Model\ModelAbstract;
use Omnipay\Tests\TestCase;

class ModelAbstractTest extends TestCase
{
    public function testConstructorSetsParameters()
    {
        $default = array('dflt' => uniqid(), 'custom' => '');
        $custom  = array('custom' => uniqid());

        $model = m::mock('Omnipay\ElementExpress\Model\ModelAbstract')->makePartial();
        $model->shouldReceive('getDefaultParameters')->once()->andReturn($default);

        $this->assertSame($model, $model->initialize($custom));
        $this->assertSame($model['dflt'], $default['dflt']);
        $this->assertSame($model['custom'], $custom['custom']);
    }
}
