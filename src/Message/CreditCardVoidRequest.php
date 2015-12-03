<?php

namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasTransactionTrait;
use Omnipay\ElementExpress\HasTerminalTrait;

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

    /**
     * Send data
     *
     * @param \DOMDocument $data Data
     */
    public function sendData($data)
    {
        // Prune empty nodes.
        $xpath = new \DOMXPath($data);
        foreach ($xpath->query('//*[not(node())]') as $node) {
            $node->parentNode->removeChild($node);
        }

        $headers = ['Content-Type' => 'text/xml; charset=utf-8'];

        $httpResponse = $this->httpClient
            ->post($this->getEndpoint(), $headers, $data->saveXML())
            ->send();

        return $this->response = new Response(
            $this,
            $httpResponse->getBody()
        );
    }
}
