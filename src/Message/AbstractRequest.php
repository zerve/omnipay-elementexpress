<?php

namespace Omnipay\ElementExpress\Message;

use Omnipay\Common\Helper;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Symfony\Component\HttpFoundation\ParameterBag;

use Omnipay\ElementExpress\HasCommonAccessorsTrait;

/**
 * ElementExpress Abstract Request
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use HasCommonAccessorsTrait;

    /**
     * Override parent method to incorporate default parameters.
     *
     * @param array $parameters An associative array of parameters
     * @return $this
     * @throws RuntimeException
     */
    public function initialize(array $parameters = array())
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = new ParameterBag;

        // Set default parameters
        foreach ($this->getDefaultParameters() as $key => $value) {
            if (is_array($value)) {
                $this->parameters->set($key, reset($value));
            } else {
                $this->parameters->set($key, $value);
            }
        }

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array();
    }

    protected function attachApplication(\SimpleXMLElement $parent)
    {
        $node = $parent->addChild('Application');
        $node->addChild('ApplicationID', $this->getApplicationID());
        $node->addChild('ApplicationName', $this->getApplicationName());
        $node->addChild('ApplicationVersion', $this->getApplicationVersion());
    }

    protected function attachCredentials(\SimpleXMLElement $parent)
    {
        $node = $parent->addChild('Credentials');
        $node->addChild('AccountID', $this->getAccountID());
        $node->addChild('AccountToken', $this->getAccountToken());
        $node->addChild('AcceptorID', $this->getAcceptorID());
    }
}
