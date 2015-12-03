<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasTerminalTrait;
use Omnipay\ElementExpress\HasTransactionTrait;

/**
 * ElementExpress CreditCardVoid Request
 */
class CreditCardVoidRequest extends AbstractRequest
{
    use HasTransactionTrait;
    use HasTerminalTrait;

    /**
     * Get data
     *
     * @return \SimpleXMLElement
     */
    public function getData()
    {
        $doc  = new \DOMDocument('1.0');
        $node = $doc->appendChild(new \DOMElement('CreditCardVoid', null, 'https://transaction.elementexpress.com'));
        $this->getApplication()->appendToDom($node);
        $this->getCredentials()->appendToDom($node);
        $this->getTransaction()->appendToDom($node);
        $this->getTerminal()->appendToDom($node);

        return $doc;
    }
}
