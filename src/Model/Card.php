<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\ElementExpress\Enumeration\EncryptedFormat;

class Card extends ModelAbstract
{
    public function getDefaultParameters()
    {
        return [

            // Elements corresponding directly with standard Omnipay parameter
            // names use those same names here instead of ElementExpress names.

            'number'                  => '', // ElementExpress "CardNumber"
            'expiryMonth'             => '', // ElementExpress "ExpirationMonth"
            'expiryYear'              => '', // ElementExpress "ExpirationYear"
            'cvv'                     => '', // ElementExpress "CVV"

            // Remaining elements correspond to ElementExpress parameters.

            'Track1Data'              => '',
            'Track2Data'              => '',
            'MagneprintData'          => '',
            'EncryptedTrack1Data'     => '',
            'EncryptedTrack2Data'     => '',
            'EncryptedCardData'       => '',

            'CardDataKeySerialNumber' => '',
            'EncryptedFormat'         => EncryptedFormat::__DEFAULT(),

        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Card'));

        // Append parameters.

        $node->appendChild(new \DOMElement('CVV', $this['cvv']));

        // Only one of the following field groups needs to be included; If more
        // than one is present, they will be given the following order of
        // precedence. To avoid unintended results only populate one field per
        // transaction.

        $cardData = [
            'MagneprintData'      => false,
            'EncryptedTrack2Data' => true,
            'EncryptedTrack1Data' => true,
            'EncryptedCardData'   => true,
            'Track2Data'          => false,
            'Track1Data'          => false,
            // CardNumber, ExpirationMonth, Expiration Year
        ];

        do {

            foreach ($cardData as $field => $isEncrypted) {
                if (!empty($this[$field])) {
                    $node->appendChild(new \DOMElement($field, strtoupper($this[$field])));
                    if ($isEncrypted) {
                        $node->appendChild(
                            new \DOMElement('CardDataKeySerialNumber', strtoupper($this['CardDataKeySerialNumber']))
                        );
                        $node->appendChild(new \DOMElement('EncryptedFormat', $this['EncryptedFormat']->value()));
                    }
                    break 2;
                }
            }

            if (!empty($this['number'])) {
                $node->appendChild(new \DOMElement('CardNumber', $this['number']));
            }

            if (!empty($this['expiryMonth']) && !empty($this['expiryYear'])) {
                $time = gmmktime(0, 0, 0, $this['expiryMonth'], 1, $this['expiryYear']);
                $node->appendChild(new \DOMElement('ExpirationMonth', gmdate('m', $time)));
                $node->appendChild(new \DOMElement('ExpirationYear', gmdate('y', $time)));
            }

        } while (false);

    }
}
