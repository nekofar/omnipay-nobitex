<?php

namespace Omnipay\Nobitex\Tests;

use Omnipay\Nobitex\Message\PurchaseCompleteResponse;
use Omnipay\Nobitex\Message\PurchaseResponse;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\Nobitex\Gateway;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * @var array
     */
    protected $options;

    protected function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setApiKey('DemoApiKey');
        $this->gateway->setReturnUrl('https://www.example.com/return');

        $this->options = [
            'amount' => 10000,
            'description' => 'Example',
            'mobile' => '09123456789',
        ];
    }

    /**
     *
     */
    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        /** @var PurchaseResponse $response */
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('https://nobitex.market/app/paygate/e9282e56c83f93eb077043e5ad8b6cf5b3ff7568', $response->getRedirectUrl());
    }

    /**
     *
     */
    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        /** @var PurchaseResponse $response */
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Amount min value is 10,000 rls.', $response->getMessage());
    }

    /**
     *
     */
    public function testCompletePurchaseSuccess()
    {
        $this->setMockHttpResponse('PurchaseCompleteSuccess.txt');

        $this->getHttpRequest()->request->replace([
            'amount' => '10000',
            'token' => 'e9282e56c83f93eb077043e5ad8b6cf5b3ff7568',
        ]);

        /** @var PurchaseCompleteResponse $response */
        $response = $this->gateway->completePurchase([
            'amount' => '10000',
            'token' => 'e9282e56c83f93eb077043e5ad8b6cf5b3ff7568',
        ])->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('9dd865edc8d7927495aa2439ff3e7c94', $response->getTransactionReference());
    }

    /**
     *
     */
    public function testCompletePurchaseFailure()
    {
        $this->setMockHttpResponse('PurchaseCompleteFailure.txt');

        $this->getHttpRequest()->request->replace([
            'amount' => '10000',
            'token' => 'e9282e56c83f93eb077043e5ad8b6cf5b3ff7568',
        ]);

        /** @var PurchaseCompleteResponse $response */
        $response = $this->gateway->completePurchase([
            'amount' => '10000',
            'token' => 'e9282e56c83f93eb077043e5ad8b6cf5b3ff7568',
        ])->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('Invalid token.', $response->getMessage());
    }
}