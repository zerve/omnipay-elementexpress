<?php
namespace Omnipay\ElementExpress\Tests\Model;

use Omnipay\ElementExpress\Model\Transaction;
use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\Tests\TestCase;

class TransactionTest extends TestCase
{
    //
    // Generic Data Validation
    //

    public function invalidData()
    {
        return [
            'amount: too-long'               => ['amount', str_repeat('9', 11)],
            'amount: bad-format (decimals)'  => ['amount', '1.11.1'],
            'amount: bad-format (alpha)'     => ['amount', '1.11.1'],
            'amount: bad-format (negative)'  => ['amount', '-1.00'],
            'MarketCode: invalid-value'      => ['MarketCode', 0],
            'transactionReference: too-long' => ['transactionReference', str_repeat('x', 11)],
            'transactionId: too-long'        => ['transactionId', str_repeat('x', 51)],
            'PartialApprovedFlag: non-bool'  => ['PartialApprovedFlag', '5'],
        ];
    }

    public function validData()
    {
        return [
            'amount: max-length'               => ['amount', str_repeat('9', 10)],
            'amount: valid (1 decimal)'        => ['amount', '1.2'],
            'amount: valid (2 decimal)'        => ['amount', '1.25'],
            'amount: valid (3 decimal)'        => ['amount', '1.253'],
            'MarketCode: valid-enum'           => ['MarketCode', MarketCode::__DEFAULT()],
            'transactionReference: max-length' => ['transactionReference', str_repeat('x', 10)],
            'transactionId: max-length'        => ['transactionId', str_repeat('x', 50)],
            'PartialApprovedFlag: true'        => ['PartialApprovedFlag', "1"],
            'PartialApprovedFlag: false'       => ['PartialApprovedFlag', "0"],
        ];
    }

    /**
     * @dataProvider invalidData
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testDataValidationFails($field, $value)
    {
        $model = new Transaction();
        $model[$field] = $value;
        $model->validate();
    }

    /**
     * @dataProvider validData
     */
    public function testDataValidationSucceeds($field, $value)
    {
        $model = new Transaction();
        $model[$field] = $value;
        $model->validate();
    }
}
