<?php
/**
 * Copyright 2015 Zerve, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Omnipay\ElementExpress\Model;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Helper;
use Omnipay\ElementExpress\Enumeration\EncryptedFormat;

class Card extends AbstractModel
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

    /**
     * Model validation ensures that any data that is present in the model is
     * formatted correctly. No business logic validation is performed at this
     * level.
     *
     * @throws InvalidRequestException if validation fails.
     */
    public function validate()
    {
        if (strlen($this['number'])) {
            if (!preg_match('/^\d{12,19}$/', $this['number'])) {
                throw new InvalidRequestException('Card number should have 12 to 19 digits');
            }
            if (!Helper::validateLuhn($this['number'])) {
                throw new InvalidRequestException('Card number is invalid');
            }
        }

        if (strlen($this['expiryMonth'] && strlen($this['expiryYear']))) {
            $time = gmmktime(0, 0, 0, $this['expiryMonth'], 1, $this['expiryYear']);
            if (gmdate('Ym', $time) < gmdate('Ym')) {
                throw new InvalidRequestException('Card has expired');
            }
        }

        if (strlen($this['cvv']) && !preg_match('/^\d{1,4}$/', $this['cvv'])) {
            throw new InvalidRequestException('cvv should have 4 or fewer digits');
        }

        if (strlen($this['Track1Data']) && !preg_match('/^.{1,76}$/', $this['Track1Data'])) {
            throw new InvalidRequestException('Track1Data should have 76 or fewer characters');
        }

        if (strlen($this['Track2Data']) && !preg_match('/^.{1,37}$/', $this['Track2Data'])) {
            throw new InvalidRequestException('Track2Data should have 37 or fewer characters');
        }

        if (strlen($this['MagneprintData']) && !preg_match('/^.{1,700}$/', $this['MagneprintData'])) {
            throw new InvalidRequestException('MagneprintData should have 700 or fewer characters');
        }

        if (strlen($this['EncryptedTrack1Data']) && !preg_match('/^.{1,300}$/', $this['EncryptedTrack1Data'])) {
            throw new InvalidRequestException('EncryptedTrack1Data should have 300 or fewer characters');
        }

        if (strlen($this['EncryptedTrack2Data']) && !preg_match('/^.{1,200}$/', $this['EncryptedTrack2Data'])) {
            throw new InvalidRequestException('EncryptedTrack2Data should have 200 or fewer characters');
        }

        if (strlen($this['EncryptedCardData']) && !preg_match('/^.{1,200}$/', $this['EncryptedCardData'])) {
            throw new InvalidRequestException('EncryptedCardData should have 200 or fewer characters');
        }

        if (strlen($this['CardDataKeySerialNumber']) && !preg_match('/^.{1,26}$/', $this['CardDataKeySerialNumber'])) {
            throw new InvalidRequestException('CardDataKeySerialNumber should have 26 or fewer characters');
        }

        if (isset($this['EncryptedFormat']) && !$this['EncryptedFormat'] instanceof EncryptedFormat) {
            throw new InvalidRequestException('Invalid value for EncryptedFormat');
        }
    }
}
