<?php

namespace Omnipay\ElementExpress\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * ElementExpress Response
 */
class Response extends AbstractResponse
{
    /**
     * Constructor
     *
     * @param RequestInterface $request Request
     * @param string           $data    Data
     * @throws InvalidResponseException if $data is empty
     */
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;

        if (empty($data)) {
            throw new InvalidResponseException();
        }

        $implementation = new \DOMImplementation();
        $responseDom = $implementation->createDocument();
        $responseDom->loadXML($data);

        $this->data = simplexml_import_dom(
            $responseDom->documentElement->firstChild
        );
    }

    public function isSuccessful()
    {
        if (isset($this->data->ExpressResponseCode)) {
            if ("0" === (string) $this->data->ExpressResponseCode) {
                return true;
            }
        }
        return false;
    }

    public function getCode()
    {
        return $this->data->ExpressResponseCode;
    }

    public function getMessage()
    {
        return $this->data->ExpressResponseMessage;
    }
}
