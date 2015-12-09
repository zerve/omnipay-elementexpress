<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Omnipay\ElementExpress\Model\Application;
use Omnipay\Tests\TestCase;

class ApplicationTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'ApplicationID: too-long'        => ['ApplicationID', str_repeat('x', 41)],
            'ApplicationName: too-long'      => ['ApplicationName', str_repeat('x', 51)],
            'ApplicationVersion: too-long'   => ['ApplicationVersion', str_pad('1.2.', 51, '3')],
            'ApplicationVersion: bad-format' => ['ApplicationVersion', '123'],
        ];
    }

    public function validData()
    {
        return [
            'ApplicationID: max-length'      => ['ApplicationID', str_repeat('x', 40)],
            'ApplicationName: max-length'    => ['ApplicationName', str_repeat('x', 50)],
            'ApplicationVersion: max-length' => ['ApplicationVersion', str_pad('1.2.', 50, '3')],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new Application();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new Application();
        $model[$field] = $value;
        $model->validate();
    }
}
