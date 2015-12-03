<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasCardTrait;
use Omnipay\ElementExpress\HasTerminalTrait;
use Omnipay\ElementExpress\HasTransactionTrait;

/**
 * ElementExpress CreditCardSale Request
 */
class CreditCardSaleRequest extends AbstractRequest
{
    use HasTransactionTrait;
    use HasTerminalTrait;
    use HasCardTrait;

    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        // $this->validate('amount', 'card');
        // $this->getCard()->validate();

        $doc  = new \DOMDocument('1.0');
        $node = $doc->appendChild(new \DOMElement('CreditCardSale', null, 'https://transaction.elementexpress.com'));
        $this->getApplication()->appendToDom($node);
        $this->getCredentials()->appendToDom($node);
        $this->getTransaction()->appendToDom($node);
        $this->getTerminal()->appendToDom($node);
        $this->getCard()->appendToDom($node);
        return $doc;
    }
}
