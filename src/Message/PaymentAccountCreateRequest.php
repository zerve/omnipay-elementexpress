<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasCardTrait;
use Omnipay\ElementExpress\HasPaymentAccountTrait;

/**
 * ElementExpress CreditCardVoid Request
 */
class PaymentAccountCreateRequest extends AbstractServicesRequest
{
    use HasCardTrait;
    use HasPaymentAccountTrait;

    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        return $this->domDocumentFactory('PaymentAccountCreate', ...[
            $this->getApplication(),
            $this->getCredentials(),
            $this->getPaymentAccount(),
            $this->getCard(),
        ]);
    }
}
