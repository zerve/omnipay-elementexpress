<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\CardPresentCode;
use Omnipay\ElementExpress\Enumeration\CardholderPresentCode;
use Omnipay\ElementExpress\Enumeration\CardInputCode;
use Omnipay\ElementExpress\Enumeration\CVVPresenceCode;
use Omnipay\ElementExpress\Enumeration\TerminalCapabilityCode;
use Omnipay\ElementExpress\Enumeration\TerminalEnvironmentCode;
use Omnipay\ElementExpress\Enumeration\TerminalType;
use Omnipay\ElementExpress\Enumeration\MotoECICode;

class Terminal extends ModelAbstract
{
    public function getDefaultParameters()
    {
        return [
            'TerminalID'              => '',
            'TerminalType'            => TerminalType::UNKNOWN(),
            'CardPresentCode'         => CardPresentCode::__DEFAULT(),
            'CardholderPresentCode'   => CardholderPresentCode::__DEFAULT(),
            'CardInputCode'           => CardInputCode::__DEFAULT(),
            'CVVPresenceCode'         => CVVPresenceCode::__DEFAULT(),
            'TerminalCapabilityCode'  => TerminalCapabilityCode::__DEFAULT(),
            'TerminalEnvironmentCode' => TerminalEnvironmentCode::__DEFAULT(),
            'MotoECICode'             => MotoECICode::__DEFAULT(),
            'TerminalSerialNumber'    => '',
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Terminal'));
        $node->appendChild(new \DOMElement('TerminalID', $this['TerminalID']));
        $node->appendChild(new \DOMElement('TerminalType', $this['TerminalType']->value()));
        $node->appendChild(new \DOMElement('CardPresentCode', $this['CardPresentCode']->value()));
        $node->appendChild(new \DOMElement('CardholderPresentCode', $this['CardholderPresentCode']->value()));
        $node->appendChild(new \DOMElement('CardInputCode', $this['CardInputCode']->value()));
        $node->appendChild(new \DOMElement('CVVPresenceCode', $this['CVVPresenceCode']->value()));
        $node->appendChild(new \DOMElement('TerminalCapabilityCode', $this['TerminalCapabilityCode']->value()));
        $node->appendChild(new \DOMElement('TerminalEnvironmentCode', $this['TerminalEnvironmentCode']->value()));
        $node->appendChild(new \DOMElement('MotoECICode', $this['MotoECICode']->value()));
        $node->appendChild(new \DOMElement('TerminalSerialNumber', $this['TerminalSerialNumber']));
    }
}
