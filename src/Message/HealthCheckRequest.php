<?php
namespace Omnipay\ElementExpress\Message;

/**
 * ElementExpress HealthCheck Request
 */
class HealthCheckRequest extends AbstractTransactionRequest
{
    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        return $this->domDocumentFactory('HealthCheck');
    }
}
