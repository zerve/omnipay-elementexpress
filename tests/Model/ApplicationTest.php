<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Mockery as m;
use Omnipay\Tests\TestCase;

class ApplicationTest extends TestCase
{
    //
    // ApplicationID Validation
    //

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testApplicationIDValidationFails()
    {
        $model = new \Omnipay\ElementExpress\Model\Application;
        $model['ApplicationID'] = 'tooLong' . str_repeat('x', 41);
        $model->validate();
    }

    public function testApplicationIDValidationSucceeds()
    {
        $model = new \Omnipay\ElementExpress\Model\Application;
        $model['ApplicationID'] = 'maxLength' . str_repeat('x', 40 - strlen('maxLength'));
        $model->validate();
    }

    //
    // ApplicationName Validation
    //

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testApplicationNameValidationFails()
    {
        $model = new \Omnipay\ElementExpress\Model\Application;
        $model['ApplicationName'] = 'tooLong' . str_repeat('x', 51);
        $model->validate();
    }

    public function testApplicationNameValidationSucceeds()
    {
        $model = new \Omnipay\ElementExpress\Model\Application;
        $model['ApplicationName'] = 'maxLength' . str_repeat('x', 50 - strlen('maxLength'));
        $model->validate();
    }

    //
    // ApplicationVersion Validation
    //

    public function applicationVersionFailureDataProvider()
    {
        return [
            ['1.2.' . str_repeat('3', 51)], // Too long
            ['badFormat'],
        ];
    }

    /**
     * @dataProvider applicationVersionFailureDataProvider
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testApplicationVersionValidationFails($value)
    {
        $model = new \Omnipay\ElementExpress\Model\Application;
        $model['ApplicationVersion'] = $value;
        $model->validate();
    }

    public function testApplicationVersionValidationSucceeds()
    {
        $model = new \Omnipay\ElementExpress\Model\Application;
        $model['ApplicationVersion'] = '1.2.' . str_repeat('3', 50 - strlen('1.2.'));
        $model->validate();
    }

}
