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

namespace Omnipay\ElementExpress;

use Omnipay\Common\AbstractGateway;
use Omnipay\ElementExpress\Model\ApplicationTrait;
use Omnipay\ElementExpress\Model\CredentialsTrait;

/**
 * ElementExpress Gateway
 *
 * @todo docs for http://bit.ly/1IgpTzy are good
 * @todo xml example: http://bit.ly/1lhLIcN
 */
class Gateway extends AbstractGateway
{
    use ApplicationTrait;
    use CredentialsTrait;

    const NAME    = 'omnipay/elementexpress';
    const VERSION = '1.0.0';

    public function getName()
    {
        return 'ElementExpress';
    }

    /**
     * Get default parameters. All parameters common to the Gateway and requests
     * are listed here, even those which don't actually have any defaults. This
     * helps document required parameters, but also helps unit tests ensure that
     * the necessary accessors are present to pass parameters from Gateway to
     * request.
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return [

            // Credentials Model
            'AccountID'               => '',
            'AccountToken'            => '',
            'AcceptorID'              => '',

            // Application Model
            'ApplicationID'           => '',
            'ApplicationName'         => self::NAME,
            'ApplicationVersion'      => self::VERSION,

            // Omnipay Internal
            'testMode'                => false,

        ];
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\CreditCardSaleRequest', $parameters);
    }

    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\CreditCardVoidRequest', $parameters);
    }

    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\PaymentAccountCreateRequest', $parameters);
    }

    //
    // These are methods specific to the ElementExpress interface.
    //

    public function expressReturn(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\CreditCardReturnRequest', $parameters);
    }

    public function expressCredit(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\CreditCardCreditRequest', $parameters);
    }

    public function expressReversal(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\CreditCardReversalRequest', $parameters);
    }

    public function healthCheck(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\HealthCheckRequest', $parameters);
    }

    public function paymentAccountQuery(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\PaymentAccountQueryRequest', $parameters);
    }
}
