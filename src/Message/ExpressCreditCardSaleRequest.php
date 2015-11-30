<?php

namespace Omnipay\Vantiv\Message;

use Omnipay\Vantiv\Enumeration\CardholderPresentCode;
use Omnipay\Vantiv\Enumeration\CardInputCode;
use Omnipay\Vantiv\Enumeration\CardPresentCode;
use Omnipay\Vantiv\Enumeration\CVVPresenceCode;
use Omnipay\Vantiv\Enumeration\MarketCode;
use Omnipay\Vantiv\Enumeration\MotoECICode;
use Omnipay\Vantiv\Enumeration\TerminalCapabilityCode;
use Omnipay\Vantiv\Enumeration\TerminalEnvironmentCode;
use Omnipay\Vantiv\Message\ExpressAbstractRequest;

/**
 * Omnipay Vantiv Express CreditCardSale Request
 */
class ExpressCreditCardSaleRequest extends ExpressAbstractRequest
{

    /**
     * Get default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return [

            // Transaction
            'marketCode'              => MarketCode::__DEFAULT(),

            // Terminal
            'terminalID'              => '',
            'cardPresentCode'         => CardPresentCode::__DEFAULT(),
            'cardholderPresentCode'   => CardholderPresentCode::__DEFAULT(),
            'cardInputCode'           => CardInputCode::__DEFAULT(),
            'cvvPresenceCode'         => CVVPresenceCode::__DEFAULT(),
            'terminalCapabilityCode'  => TerminalCapabilityCode::__DEFAULT(),
            'terminalEnvironmentCode' => TerminalEnvironmentCode::__DEFAULT(),
            'motoECICode'             => MotoECICode::__DEFAULT(),

        ];
    }

    /**
     * Get data
     *
     * @return \SimpleXMLElement
     */
    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = new \SimpleXMLElement('<CreditCardSale />');
        $data->addAttribute('xmlns', 'https://transaction.elementexpress.com');

        $this->attachApplication($data);
        $this->attachCredentials($data);
        $this->attachTransaction($data);
        $this->attachTerminal($data);
        $this->attachCard($data);

        return $data;
    }

    protected function attachTransaction(\SimpleXMLElement $parent)
    {
        $node = $parent->addChild('Transaction');
        $node->addChild('TransactionAmount', $this->getAmount());
        $node->addChild('MarketCode', $this->getMarketCode()->value());
    }

    protected function attachTerminal(\SimpleXMLElement $parent)
    {
        $node = $parent->addChild('Terminal');
        $node->addChild('TerminalID', $this->getTerminalID());
        $node->addChild('CardPresentCode', $this->getCardPresentCode()->value());
        $node->addChild('CardholderPresentCode', $this->getCardholderPresentCode()->value());
        $node->addChild('CardInputCode', $this->getCardInputCode()->value());
        $node->addChild('CVVPresenceCode', $this->getRealCVVPresenceCode()->value());
        $node->addChild('TerminalCapabilityCode', $this->getTerminalCapabilityCode()->value());
        $node->addChild('TerminalEnvironmentCode', $this->getTerminalEnvironmentcode()->value());
        $node->addChild('MotoECICode', $this->getMotoECICode()->value());
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
    protected function attachCard(\SimpleXMLElement $parent)
    {
        $node = $parent->addChild('Card');
        $card = $this->getCard();

        switch (true) {

            default:

                if (!empty($card->getNumber())) {
                    $node->addChild('CardNumber', $card->getNumber());
                }

                if (!empty($card->getExpiryMonth()) && !empty($card->getExpiryYear())) {
                    $node->addChild('ExpirationMonth', $card->getExpiryDate('m'));
                    $node->addChild('ExpirationYear', $card->getExpiryDate('y'));
                }

        }

        // $node->addChild('CVV', $card->getCvv());

    }

    /**
     * If the CVVPresenceCode is set to __DEFAULT, update it to either PROVIDED
     * or NOT_PROVIDED depending on whether or not the CVV value is present in
     * the card data. If the value of CVVPresenceCode is something other than
     * __DEFAULT, leave it alone.
     *
     * @return CardPresentCode
     */
    protected function getRealCVVPresenceCode()
    {
        $code = $this->getCVVPresenceCode();
        if ($code === CVVPresenceCode::__DEFAULT()) {
            if (!empty($this->getCard()->getCvv())) {
                $code = CVVPresenceCode::PROVIDED();
            } else {
                $code = CVVPresenceCode::NOT_PROVIDED();
            }
        }
        return $code;
    }

    /**
     * Send data
     *
     * @param \SimpleXMLElement $data Data
     *
     * @access public
     * @return RedirectResponse
     */
    public function sendData($data)
    {
        $implementation = new \DOMImplementation();

        $document = $implementation->createDocument();
        $document->encoding = 'utf-8';

        $node = $document->importNode(dom_import_simplexml($data), true);
        $document->appendChild($node);

        $xml = $document->saveXML();

        $headers = ['Content-Type' => 'text/xml; charset=utf-8'];

        $httpResponse = $this->httpClient
            ->post($this->getEndpoint(), $headers, $xml)
            ->send();

        return $this->response = new ExpressResponse(
            $this,
            $httpResponse->getBody()
        );
    }

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

    //
    // Accessors and Mutators Follow
    //

    public function getMarketCode()
    {
        return $this->getParameter('marketCode');
    }

    public function setMarketCode(MarketCode $value)
    {
        return $this->setParameter('marketCode', $value);
    }

    public function getTerminalID()
    {
        return $this->getParameter('terminalID');
    }

    public function setTerminalID($value)
    {
        return $this->setParameter('terminalID', $value);
    }

    public function getCardPresentCode()
    {
        return $this->getParameter('cardPresentCode');
    }

    public function setCardPresentCode(CardPresentCode $value)
    {
        return $this->setParameter('cardPresentCode', $value);
    }

    public function getCardholderPresentCode()
    {
        return $this->getParameter('cardholderPresentCode');
    }

    public function setCardholderPresentCode(CardholderPresentCode $value)
    {
        return $this->setParameter('cardholderPresentCode', $value);
    }

    public function getCardInputCode()
    {
        return $this->getParameter('cardInputCode');
    }

    public function setCardInputCode(CardInputCode $value)
    {
        return $this->setParameter('cardInputCode', $value);
    }

    public function getCVVPresenceCode()
    {
        return $this->getParameter('cvvPresenceCode');
    }

    public function setCVVPresenceCode(CVVPresenceCode $value)
    {
        return $this->setParameter('cvvPresenceCode', $value);
    }

    public function getTerminalCapabilityCode()
    {
        return $this->getParameter('terminalCapabilityCode');
    }

    public function setTerminalCapabilityCode(TerminalCapabilityCode $value)
    {
        return $this->setParameter('terminalCapabilityCode', $value);
    }

    public function getTerminalEnvironmentCode()
    {
        return $this->getParameter('terminalEnvironmentCode');
    }

    public function setTerminalEnvironmentCode(TerminalEnvironmentCode $value)
    {
        return $this->setParameter('terminalEnvironmentCode', $value);
    }

    public function getMotoECICode()
    {
        return $this->getParameter('motoECICode');
    }

    public function setMotoECICode(MotoECICode $value)
    {
        return $this->setParameter('motoECICode', $value);
    }
}
