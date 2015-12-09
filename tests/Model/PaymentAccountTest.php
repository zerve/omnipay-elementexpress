<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Omnipay\ElementExpress\Model\PaymentAccount;
use Omnipay\ElementExpress\Enumeration\PaymentAccountType;
use Omnipay\Tests\TestCase;

class PaymentAccountTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'cardReference: too-long'                 => ['cardReference', str_repeat('x', 51)],
            'PaymentAccountType: invalid-value'       => ['PaymentAccountType', 0],
            'PaymentAccountReferenceNumber: too-long' => ['PaymentAccountReferenceNumber', str_repeat('x', 51)],
        ];
    }

    public function validData()
    {
        return [
            'cardReference: max-length'                 => ['cardReference', str_repeat('x', 50)],
            'PaymentAccountType: valid-enum'            => ['PaymentAccountType', PaymentAccountType::CREDIT_CARD()],
            'PaymentAccountReferenceNumber: max-length' => ['PaymentAccountReferenceNumber', str_repeat('x', 50)],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new PaymentAccount();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new PaymentAccount();
        $model[$field] = $value;
        $model->validate();
    }
}
