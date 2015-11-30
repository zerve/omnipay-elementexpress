<?php

namespace Omnipay\Vantiv;

use Omnipay\Common\AbstractGateway;

use Omnipay\Vantiv\Enumeration\CardholderPresentCode;
use Omnipay\Vantiv\Enumeration\CardInputCode;
use Omnipay\Vantiv\Enumeration\CardPresentCode;
use Omnipay\Vantiv\Enumeration\CVVPresenceCode;
use Omnipay\Vantiv\Enumeration\MarketCode;
use Omnipay\Vantiv\Enumeration\MotoECICode;
use Omnipay\Vantiv\Enumeration\TerminalCapabilityCode;
use Omnipay\Vantiv\Enumeration\TerminalEnvironmentCode;

/**
 * Vantiv Express Class
 *
 * @todo docs for http://bit.ly/1IgpTzy are good
 * @todo xml example: http://bit.ly/1lhLIcN
 */
class ExpressGateway extends AbstractGateway
{
    use HasCommonAccessorsTrait;

    const NAME    = 'omnipay/vantiv';
    const VERSION = '1.0.0';

    public function getName()
    {
        return 'Vantiv Express';
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
        return $this->createRequest('\Omnipay\Vantiv\Message\ExpressCreditCardSaleRequest', $parameters);
    }
}
