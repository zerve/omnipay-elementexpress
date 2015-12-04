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
     * @return \SimpleXMLElement
     */
    public function getData()
    {
        $this->validate('amount');

        $doc  = new \DOMDocument('1.0');
        $node = $doc->appendChild(new \DOMElement('CreditCardReturn', null, 'https://transaction.elementexpress.com'));
        $this->getApplication()->appendToDom($node);
        $this->getCredentials()->appendToDom($node);
        $this->getTransaction()->appendToDom($node);
        $this->getTerminal()->appendToDom($node);

        return $doc;
    }
}
