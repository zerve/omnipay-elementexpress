<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\Model\CardTrait;
use Omnipay\ElementExpress\Model\PaymentAccountTrait;

/**
 * ElementExpress CreditCardVoid Request
 */
class PaymentAccountCreateRequest extends AbstractServicesRequest
{
    use CardTrait;
    use PaymentAccountTrait;

    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        return $this->domDocumentFactory('PaymentAccountCreate');
    }
}
