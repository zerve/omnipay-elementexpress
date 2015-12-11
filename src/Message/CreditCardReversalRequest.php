<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\Model\CardTrait;
use Omnipay\ElementExpress\Model\PaymentAccountTrait;
use Omnipay\ElementExpress\Model\TerminalTrait;
use Omnipay\ElementExpress\Model\TransactionTrait;

/**
 * ElementExpress CreditCardReversal Request
 */
class CreditCardReversalRequest extends AbstractTransactionRequest
{
    use CardTrait;
    use PaymentAccountTrait;
    use TerminalTrait;
    use TransactionTrait;

    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        // $this->validate('amount');
        return $this->domDocumentFactory('CreditCardReversal');
    }
}
