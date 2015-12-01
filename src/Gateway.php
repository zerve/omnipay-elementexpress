<?php

namespace Omnipay\ElementExpress;

use Omnipay\Common\AbstractGateway;

use Omnipay\ElementExpress\Enumeration\CardholderPresentCode;
use Omnipay\ElementExpress\Enumeration\CardInputCode;
use Omnipay\ElementExpress\Enumeration\CardPresentCode;
use Omnipay\ElementExpress\Enumeration\CVVPresenceCode;
use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\ElementExpress\Enumeration\MotoECICode;
use Omnipay\ElementExpress\Enumeration\TerminalCapabilityCode;
use Omnipay\ElementExpress\Enumeration\TerminalEnvironmentCode;

/**
 * ElementExpress Gateway
 *
 * @todo docs for http://bit.ly/1IgpTzy are good
 * @todo xml example: http://bit.ly/1lhLIcN
 */
class Gateway extends AbstractGateway
{
    use HasCommonAccessorsTrait;

    const NAME    = 'omnipay/elementexpress';
    const VERSION = '1.0.0';

    public function getName()
    {
        return 'ElementExpress';
    }

    /**
     * Get default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return [

            // Account
            'accountID'               => '',
            'accountToken'            => '',
            'acceptorID'              => '',

            // Credentials
            'applicationID'           => '',
            'applicationName'         => self::NAME,
            'applicationVersion'      => self::VERSION,

            // Misc
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
