<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasTransactionTrait;
use Omnipay\ElementExpress\HasTerminalTrait;

/**
 * ElementExpress CreditCardSale Request
 */
class CreditCardSaleRequest extends AbstractRequest
{
    use HasTransactionTrait;
    use HasTerminalTrait;

    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $doc  = new \DOMDocument('1.0');
        $node = $doc->appendChild(new \DOMElement('CreditCardSale', null, 'https://transaction.elementexpress.com'));
        $this->getApplication()->appendToDom($node);
        $this->getCredentials()->appendToDom($node);
        $this->getTransaction()->appendToDom($node);
        $this->getTerminal()->appendToDom($node);

        $this->attachCard($node);
        return $doc;
    }

    /**
     * Send data
     *
     * @param \DOMDocument $data Data
     */
    public function sendData($data)
    {
        $headers = ['Content-Type' => 'text/xml; charset=utf-8'];

        $httpResponse = $this->httpClient
            ->post($this->getEndpoint(), $headers, $data->saveXML())
            ->send();

        return $this->response = new Response(
            $this,
            $httpResponse->getBody()
        );
    }

    /**
     * Only one of the following field groups needs to be included:
     *
     *  - CardNumber / ExpirationMonth / ExpirationYear
     *  - Track1Data
     *  - Track2Data
     *  - MagneprintData
     *  - PaymentAccountID
     *  - EncryptedTrack1Data
     *  - EncryptedTrack2Data
     *  - EncryptedCardData.
     *
     * If more than one field is populated they will be given the following
     * order of precedence:
     *
     *  - MagneprintData
     *  - EncryptedTrack2Data
     *  - EncryptedTrack1Data
     *  - EncryptedCardData
     *  - Track2Data
     *  - Track1Data
     *  - PaymentAccountID
     *  - CardNumber
     *
     * To avoid unintended results only populate one field per transaction.
     */
    protected function attachCard(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Card'));
        $card = $this->getCard();

        switch (true) {

            default:

                if (!empty($card->getNumber())) {
                    $node->appendChild(new \DOMElement('CardNumber', $card->getNumber()));
                }

                if (!empty($card->getExpiryMonth()) && !empty($card->getExpiryYear())) {
                    $node->appendChild(new \DOMElement('ExpirationMonth', $card->getExpiryDate('m')));
                    $node->appendChild(new \DOMElement('ExpirationYear', $card->getExpiryDate('y')));
                }

        }

        $parent->appendChild($node);

        // $node->addChild('CVV', $card->getCvv());

    }
}
