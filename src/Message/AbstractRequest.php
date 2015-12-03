<?php

namespace Omnipay\ElementExpress\Message;

use Omnipay\Common\Helper;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Symfony\Component\HttpFoundation\ParameterBag;

use Omnipay\ElementExpress\HasApplicationTrait;
use Omnipay\ElementExpress\HasCredentialsTrait;
use Omnipay\ElementExpress\HasCommonAccessorsTrait;

/**
 * ElementExpress Abstract Request
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use HasApplicationTrait;
    use HasCredentialsTrait;
    use HasCommonAccessorsTrait;

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
}
