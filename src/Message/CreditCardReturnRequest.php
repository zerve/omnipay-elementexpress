<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\Model\TerminalTrait;
use Omnipay\ElementExpress\Model\TransactionTrait;

/**
 * ElementExpress CreditCardReturn Request
 */
class CreditCardReturnRequest extends AbstractTransactionRequest
{
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
        return $this->domDocumentFactory('CreditCardReturn', ...[
            $this->getApplication(),
            $this->getCredentials(),
            $this->getTransaction(),
            $this->getTerminal(),
        ]);
    }
}
