<?php

namespace Omnipay\ElementExpress;

use Omnipay\Common\AbstractGateway;

/**
 * ElementExpress Gateway
 *
 * @todo docs for http://bit.ly/1IgpTzy are good
 * @todo xml example: http://bit.ly/1lhLIcN
 */
class Gateway extends AbstractGateway
{
    use HasCommonAccessorsTrait;

    use HasApplicationTrait;
    use HasCredentialsTrait;

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
            'accountID'               => '',
            'accountToken'            => '',
            'acceptorID'              => '',

            // Application Model
            'applicationID'           => '',
            'applicationName'         => self::NAME,
            'applicationVersion'      => self::VERSION,

            // Omnipay Internal
            'testMode'                => false,
            'developmentEndpoint'     => 'https://certtransaction.elementexpress.com/',
            'productionEndpoint'      => ''

        ];
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\CreditCardSaleRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\ElementExpress\Message\CreditCardReturnRequest', $parameters);
    }
}