<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\Model\CardTrait;
use Omnipay\ElementExpress\Model\TerminalTrait;
use Omnipay\ElementExpress\Model\TransactionTrait;

/**
 * ElementExpress CreditCardSale Request
 */
class CreditCardSaleRequest extends AbstractTransactionRequest
{
    use CardTrait;
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
        return $this->domDocumentFactory('CreditCardSale', ...[
            $this->getApplication(),
            $this->getCredentials(),
            $this->getTransaction(),
            $this->getTerminal(),
            $this->getCard(),
        ]);
    }
}
