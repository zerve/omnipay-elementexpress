<?php
namespace Omnipay\ElementExpress\Message;

abstract class AbstractTransactionRequest extends AbstractRequest
{
    const PROD_ENDPOINT = 'https://transaction.elementexpress.com';
    const TEST_ENDPOINT = 'https://certtransaction.elementexpress.com';
    const XML_NAMESPACE = 'https://transaction.elementexpress.com';

    protected function getEndpoint()
    {
        return $this->getTestMode() ? self::TEST_ENDPOINT : self::PROD_ENDPOINT;
    }

    protected function getXmlNamespace()
    {
        return self::XML_NAMESPACE;
    }
}
