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
     * @param string $data Data
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
        $responseDom->preserveWhiteSpace = false;
        $responseDom->loadXML($data);
        $this->data = simplexml_import_dom(
            $responseDom->documentElement->firstChild
        );
    }

    public function isSuccessful()
    {
        if (isset($this->data->ExpressResponseCode)) {
            if ('0' === (string) $this->data->ExpressResponseCode) {
                return true;
            }
        }
        return false;
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        return (string) $this->data->ExpressResponseCode;
    }

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return (string) $this->data->ExpressResponseMessage;
    }

    /**
     * Get the transaction ID as generated by the merchant website.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return (string) $this->data->Transaction->ReferenceNumber;
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference()
    {
        return (string) $this->data->Transaction->TransactionID;
    }
}
