<?php
namespace Omnipay\ElementExpress\Message;

abstract class AbstractServicesRequest extends AbstractRequest
{
    const PROD_ENDPOINT = 'https://services.elementexpress.com';
    const TEST_ENDPOINT = 'https://certservices.elementexpress.com/';
    const XML_NAMESPACE = 'https://services.elementexpress.com';

    protected function getEndpoint()
    {
        return $this->getTestMode() ? self::TEST_ENDPOINT : self::PROD_ENDPOINT;
    }

    protected function getXmlNamespace()
    {
        return self::XML_NAMESPACE;
    }
}
