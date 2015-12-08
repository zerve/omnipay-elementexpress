<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\Model\TerminalTrait;
use Omnipay\ElementExpress\Model\TransactionTrait;

/**
 * ElementExpress CreditCardVoid Request
 */
class CreditCardVoidRequest extends AbstractTransactionRequest
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
        return $this->domDocumentFactory('CreditCardVoid', ...[
            $this->getApplication(),
            $this->getCredentials(),
            $this->getTransaction(),
            $this->getTerminal(),
        ]);
    }
}
