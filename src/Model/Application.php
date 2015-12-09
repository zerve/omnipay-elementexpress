<?php
namespace Omnipay\ElementExpress\Model;

class Application extends AbstractModel
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
        $config = [
            'ApplicationID' => [
                [
                    'regexp'  => '/^.{0,40}$/',
                    'message' => 'ApplicationID must be a string that is 40 characters or less in length',
                ]
            ],
            'ApplicationName' => [
                [
                    'regexp'  => '/^.{0,50}$/',
                    'message' => 'ApplicationName must be a string that is 50 characters or less in length',
                ]
            ],
            'ApplicationVersion' => [
                [
                    'regexp'  => '/^\d+\.\d+\.\d+$/',
                    'message' => 'ApplicationVersion must be a string in the #.#.# format',
                ],
                [
                    'regexp'  => '/^.{0,50}$/',
                    'message' => 'ApplicationVersion must be a string that is 50 characters or less in length',
                ]
            ]
        ];

        foreach ($config as $field => $rules) {
            $value = $this[$field];
            if (strlen($value)) {
                foreach ($rules as $rule) {
                    $this->validateRegex($value, $rule['regexp'], $rule['message']);
                }
            }
        }
    }
}
