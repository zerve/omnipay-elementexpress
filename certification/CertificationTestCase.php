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

namespace Omnipay\ElementExpress\Certification;

use Guzzle\Common\Event;
use Guzzle\Http\Client as HttpClient;
use Omnipay\ElementExpress\Enumeration\CardholderPresentCode;
use Omnipay\ElementExpress\Enumeration\CardInputCode;
use Omnipay\ElementExpress\Enumeration\CardPresentCode;
use Omnipay\ElementExpress\Enumeration\MarketCode;
use Omnipay\ElementExpress\Enumeration\MotoECICode;
use Omnipay\ElementExpress\Enumeration\TerminalCapabilityCode;
use Omnipay\ElementExpress\Enumeration\TerminalEnvironmentCode;
use Omnipay\ElementExpress\Enumeration\TerminalType;
use Omnipay\Omnipay;

class CertificationTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * The gateway is set up for every test.
     * @var \Omnipay\ElementExpress\Gateway $gw
     */
    protected $gw;

    /**
     * Full text of the gateway request. This is set up for each test, and is
     * shown in onNotSuccessfulTest().
     *
     * @var string $requestText;
     */
    protected $requestText = '';

    /**
     * Full text of the gateway response. This is set up for each test, and is
     * shown in onNotSuccessfulTest().
     *
     * @var string $requestText;
     */
    protected $responseText = '';

    /**
     * Buffer for test output.
     * @var string $buffer
     */
    protected static $buffer = '';

    /**
     * Description of tests in output table.
     * @var string $testDescription
     */
    protected static $testDescription = '';

    /**
     * Retail Swiped
     *
     * A Retail Swiped transaction involves a cardholder physically presenting a
     * card for payment at a merchant location, and the card is swiped using the
     * merchant point of sale application.
     *
     * These are the terminal options recommended by Element Express.
     *
     * @param array $params Parameters to add/override defaults.
     * @return array
     */
    protected function optsRetailSwiped(array $params)
    {
        return array_merge([

            // Terminal
            'TerminalID'              => '0001',
            'CardPresentCode'         => CardPresentCode::PRESENT,
            'CardholderPresentCode'   => CardholderPresentCode::PRESENT,
            'CardInputCode'           => CardInputCode::MAGSTRIPE_READ,
            'TerminalCapabilityCode'  => TerminalCapabilityCode::MAGSTRIPE_READER,
            'TerminalEnvironmentCode' => TerminalEnvironmentCode::LOCAL_ATTENDED,
            'MotoECICode'             => MotoECICode::NOT_USED,
            'TerminalType'            => TerminalType::POINT_OF_SALE,
            'TerminalSerialNumber'    => getenv('TERMINAL_SERIAL_NUMBER'),

            // Transaction
            'MarketCode'              => MarketCode::RETAIL,
            'PartialApprovedFlag'     => '1',
            'DuplicateOverrideFlag'   => '0',

        ], $params);
    }

    /**
     * Retail Keyed (due to Magnetic Stripe Failure)
     *
     * A Retail Keyed (due to Magnetic Stripe Failure) transaction involves a
     * cardholder physically presenting a card for payment at a merchant location,
     * and the card is swiped using the merchant point of sale application. However,
     * if the swipe fails for any reason, the card must be manually keyed using
     * the merchant point of sale application.
     *
     * These are the terminaloptions recommended by Element Express.
     *
     * @param array $params Parameters to add/override defaults.
     * @return array
     */
    protected function optsRetailKeyed(array $params)
    {
        return array_merge([

            // Terminal
            'TerminalID'              => '0001',
            'CardPresentCode'         => CardPresentCode::PRESENT,
            'CardholderPresentCode'   => CardholderPresentCode::PRESENT,
            'CardInputCode'           => CardInputCode::MANUAL_KEYED_MAGSTRIPE_FAILURE,
            'TerminalCapabilityCode'  => TerminalCapabilityCode::MAGSTRIPE_READER,
            'TerminalEnvironmentCode' => TerminalEnvironmentCode::LOCAL_ATTENDED,
            'MotoECICode'             => MotoECICode::NOT_USED,
            'TerminalType'            => TerminalType::POINT_OF_SALE,
            'TerminalSerialNumber'    => getenv('TERMINAL_SERIAL_NUMBER'),

            // Transaction
            'MarketCode'              => MarketCode::RETAIL,
            'PartialApprovedFlag'     => '1',
            'DuplicateOverrideFlag'   => '0',

        ], $params);
    }

    protected function setUp()
    {
        $this->requestText  = '';
        $this->responseText = '';

        $this->gw = Omnipay::create('ElementExpress', $this->getHttpClient());
        $this->gw->initialize([
            'testMode'           => true,
            'ApplicationID'      => getenv('APPLICATION_ID'),
            'AccountID'          => getenv('ACCOUNT_ID'),
            'AccountToken'       => getenv('ACCOUNT_TOKEN'),
            'AcceptorID'         => getenv('ACCEPTOR_ID'),
            'ApplicationName'    => getenv('APPLICATION_NAME'),
            'ApplicationVersion' => getenv('APPLICATION_VERSION'),
        ]);
    }

    protected function onNotSuccessfulTest(\Exception $e)
    {
        echo PHP_EOL, $this->requestText, PHP_EOL,
             PHP_EOL, $this->responseText, PHP_EOL;
        throw $e;
    }

    /**
     * Initialize an HttpClient and register an event dispatcher that will
     * record the request and response as text for us in onNotSuccessfulTest()
     *
     * @return HttpClient
     */
    protected function getHttpClient()
    {

        $client =  new HttpClient('', array(
            'curl.options' => array(
                CURLOPT_CONNECTTIMEOUT => 60
            ),
        ));

        // Echo out the response that was received
        $client->getEventDispatcher()->addListener('request.complete', function (Event $e) {

            $domImplementation = new \DOMImplementation();
            $domDocument = $domImplementation->createDocument();
            $domDocument->formatOutput = true;
            $domDocument->loadXML($e['request']->getBody());

            ob_start();
            echo $e['request']->getRawHeaders(), PHP_EOL, PHP_EOL;
            echo $domDocument->saveXML();
            $this->requestText = ob_get_clean();

            $domImplementation = new \DOMImplementation();
            $domDocument = $domImplementation->createDocument();
            $domDocument->formatOutput = true;
            $domDocument->loadXML($e['response']->getBody());

            ob_start();
            echo $e['response']->getRawHeaders();
            echo $domDocument->saveXML();
            $this->responseText = ob_get_clean();

        });

        return $client;
    }

    public static function setUpBeforeClass()
    {
        static::$buffer  = self::dataSep();
        static::$buffer .= self::dataRow(...[
            static::$testDescription, 'Amount', 'Response', 'Reference'
        ]);
        static::$buffer .= self::dataSep();
    }

    public static function tearDownAfterClass()
    {
        static::$buffer .= self::dataSep();
        echo PHP_EOL, static::$buffer, PHP_EOL;
    }

    protected static function dataSep()
    {
        return sprintf("+-%'-44s-+-%'-6s-+-%'-8s-+-%'-10s-+\n", '-', '-', '-', '-');
    }

    protected static function dataRow($description, $amount, $response, $reference)
    {
        return sprintf("| %-44s | %6s | %8s | %10s |\n", $description, $amount, $response, $reference);
    }
}
