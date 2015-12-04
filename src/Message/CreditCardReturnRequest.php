<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasTerminalTrait;
use Omnipay\ElementExpress\HasTransactionTrait;

/**
 * ElementExpress CreditCardReturn Request
 */
class CreditCardReturnRequest extends AbstractRequest
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
        // $this->validate('amount');
        return $this->domDocumentFactory('CreditCardReturn', ...[
            $this->getApplication(),
            $this->getCredentials(),
            $this->getTransaction(),
            $this->getTerminal(),
        ]);
    }
}
