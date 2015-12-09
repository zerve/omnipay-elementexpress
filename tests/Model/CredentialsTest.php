<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Omnipay\ElementExpress\Model\Credentials;
use Omnipay\Tests\TestCase;

class CredentialsTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'AccountID: too-long'       => ['AccountID', str_repeat('x', 11)],
            'AccountToken: too-long'    => ['AccountToken', str_repeat('x', 141)],
            'AcceptorID: too-long'      => ['AcceptorID', str_repeat('x', 51)],
            'NewAccountToken: too-long' => ['NewAccountToken', str_repeat('x', 141)],
        ];
    }

    public function validData()
    {
        return [
            'AccountID: max-length'       => ['AccountID', str_repeat('x', 10)],
            'AccountToken: max-length'    => ['AccountToken', str_repeat('x', 140)],
            'AcceptorID: max-length'      => ['AcceptorID', str_repeat('x', 50)],
            'NewAccountToken: max-length' => ['NewAccountToken', str_repeat('x', 140)],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new Credentials();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new Credentials();
        $model[$field] = $value;
        $model->validate();
    }
}
