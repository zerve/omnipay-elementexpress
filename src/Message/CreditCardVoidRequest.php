<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasTerminalTrait;
use Omnipay\ElementExpress\HasTransactionTrait;

/**
 * ElementExpress CreditCardVoid Request
 */
class CreditCardVoidRequest extends AbstractTransactionRequest
{
    use HasTerminalTrait;
    use HasTransactionTrait;

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
