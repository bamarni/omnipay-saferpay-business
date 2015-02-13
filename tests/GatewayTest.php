<?php

namespace Bamarni\Omnipay\Saferpay\Business\Tests;

use Bamarni\Omnipay\Saferpay\Business\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize([
            'accountId' => '99867-94913159',
            'spPassword' => 'XAjc3Kna',
        ]);
    }

    public function testCompleteAuthorizeSuccess()
    {
        $this->setMockHttpResponse('CompleteAuthorizeSuccess.txt');

        $response = $this->gateway->completeAuthorize([
            'amount' => 20.50,
            'IBAN' => 'DE17970000011234567890',
        ])->send();

        $this->assertInstanceOf('\Bamarni\Omnipay\Saferpay\Business\Message\CompleteAuthorizeResponse', $response);
        $this->assertTrue($response->isSuccessful());

        $this->assertEquals('Y29lE1bjxztCSAAfW85UA96I6Utb', $response->getTransactionReference());
    }
}
