<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\Common\Helper;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Omnipay\ElementExpress\HasApplicationTrait;
use Omnipay\ElementExpress\HasCredentialsTrait;
use Omnipay\ElementExpress\HasCommonAccessorsTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * ElementExpress Abstract Request
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use HasApplicationTrait;
    use HasCredentialsTrait;
    use HasCommonAccessorsTrait;

    /**
     * Returns either the development or production API endpoint, depending on
     * the value of the testMode parameter.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        if ($this->getTestMode()) {
            return $this->getDevelopmentEndpoint();
        }
        return $this->getProductionEndpoint();
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
