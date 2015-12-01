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
 * Omnipay Vantiv Express CreditCardRefund Request
 */
class ExpressCreditCardReturnRequest extends ExpressAbstractRequest
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
            'transactionID'           => '',
            'marketCode'              => MarketCode::__DEFAULT(),

            // Terminal
            'terminalID'              => '',
            'cardPresentCode'         => CardPresentCode::__DEFAULT(),
            'cardholderPresentCode'   => CardholderPresentCode::__DEFAULT(),
            'cardInputCode'           => CardInputCode::__DEFAULT(),
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
        $this->validate('amount');

        $data = new \SimpleXMLElement('<CreditCardReturn />');
        $data->addAttribute('xmlns', 'https://transaction.elementexpress.com');

        $this->attachApplication($data);
        $this->attachCredentials($data);
        $this->attachTransaction($data);
        $this->attachTerminal($data);

        return $data;
    }

    protected function attachTransaction(\SimpleXMLElement $parent)
    {
        $node = $parent->addChild('Transaction');
        $node->addChild('TransactionAmount', $this->getAmount());
        $node->addChild('TransactionID', $this->getTransactionID());
        $node->addChild('MarketCode', $this->getMarketCode()->value());
    }

    protected function attachTerminal(\SimpleXMLElement $parent)
    {
        $node = $parent->addChild('Terminal');
        $node->addChild('TerminalID', $this->getTerminalID());
        $node->addChild('CardPresentCode', $this->getCardPresentCode()->value());
        $node->addChild('CardholderPresentCode', $this->getCardholderPresentCode()->value());
        $node->addChild('CardInputCode', $this->getCardInputCode()->value());
        $node->addChild('TerminalCapabilityCode', $this->getTerminalCapabilityCode()->value());
        $node->addChild('TerminalEnvironmentCode', $this->getTerminalEnvironmentcode()->value());
        $node->addChild('MotoECICode', $this->getMotoECICode()->value());
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
