<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\Common\Helper;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Omnipay\ElementExpress\HasApplicationTrait;
use Omnipay\ElementExpress\HasCredentialsTrait;
use Omnipay\ElementExpress\Model\ModelAbstract;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * ElementExpress Abstract Request
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use HasApplicationTrait;
    use HasCredentialsTrait;

    abstract protected function getEndpoint();
    abstract protected function getXmlNamespace();

    /**
     * Create a DOM document using the provide $tagName and correct namespace as
     * the document element.
     *
     * @param string $tagName The name of the tag for the documentElement
     * @param ModelAbstract $models Variable length list of ModelAbstract instances.
     * @return \DOMDocument
     */
    protected function domDocumentFactory($tagName, ModelAbstract ...$models)
    {
        $namespace = $this->getXmlNamespace();
        $document  = new \DOMDocument('1.0');
        $document->appendChild(new \DOMElement($tagName, null, $namespace));
        foreach ($models as $model) {
            $model->appendToDom($document->documentElement);
        }
        return $document;
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
