<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\Model\AddressTrait;
use Omnipay\ElementExpress\Model\CardTrait;
use Omnipay\ElementExpress\Model\TerminalTrait;
use Omnipay\ElementExpress\Model\TransactionTrait;
use Omnipay\ElementExpress\Model\PaymentAccountTrait;

/**
 * ElementExpress CreditCardSale Request
 */
class CreditCardSaleRequest extends AbstractTransactionRequest
{
    use AddressTrait;
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
        // $this->validate('amount', 'card');
        // $this->getCard()->validate();
        return $this->domDocumentFactory('CreditCardSale');
    }
}
