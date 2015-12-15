<?php
namespace Omnipay\ElementExpress\Certification\PaymentAccountSecureStorage;

use Omnipay\ElementExpress\Certification\CertificationTestCase;

/**
 * @group certification
 */
class HealthCheckTest extends CertificationTestCase
{
    protected static $testDescription = 'Health Check';

    public function testHealthCheck()
    {
        $response = $this->gw->healthCheck()->send();
        $this->assertSame("0", $response->getCode());

        static::$buffer .= self::dataRow(...[
            'HealthCheck', 'N/A', $response->getCode(), 'N/A'
        ]);
    }
}
