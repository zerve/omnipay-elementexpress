<?php
namespace Omnipay\ElementExpress\Model;

use Omnipay\Common\Exception\InvalidRequestException;

class Application extends ModelAbstract
{
    public function getDefaultParameters()
    {
        return [
            'ApplicationID'      => '',
            'ApplicationName'    => '',
            'ApplicationVersion' => ''
        ];
    }

    public function appendToDom(\DOMNode $parent)
    {
        $node = $parent->appendChild(new \DOMElement('Application'));
        $node->appendChild(new \DOMElement('ApplicationID', $this['ApplicationID']));
        $node->appendChild(new \DOMElement('ApplicationName', $this['ApplicationName']));
        $node->appendChild(new \DOMElement('ApplicationVersion', $this['ApplicationVersion']));
    }

    public function validate()
    {
        $valid = filter_var($this['ApplicationID'], FILTER_VALIDATE_REGEXP, [
            'options' => ['regexp' => '/^.{0,40}$/']
        ]);
        if (false === $valid) {
            throw new InvalidRequestException(
                'ApplicationID must be a string that is 40 characters or less in length'
            );
        }

        $valid = filter_var($this['ApplicationName'], FILTER_VALIDATE_REGEXP, [
            'options' => ['regexp' => '/^.{0,50}$/']
        ]);
        if (false === $valid) {
            throw new InvalidRequestException(
                'ApplicationName must be a string that is 50 characters or less in length'
            );
        }

        if (strlen($this['ApplicationVersion'])) {
            $valid = filter_var($this['ApplicationVersion'], FILTER_VALIDATE_REGEXP, [
                'options' => ['regexp' => '/^\d+\.\d+\.\d+$/']
            ]);
            if (false === $valid) {
                throw new InvalidRequestException(
                    'ApplicationVersion must be a string in the #.#.# format'
                );
            }
        }

        $valid = filter_var($this['ApplicationVersion'], FILTER_VALIDATE_REGEXP, [
            'options' => ['regexp' => '/^.{0,50}$/']
        ]);
        if (false === $valid) {
            throw new InvalidRequestException(
                'ApplicationVersion must be a string that is 50 characters or less in length'
            );
        }

    }
}
