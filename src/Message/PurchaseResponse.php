<?php

/**
 * @package Omnipay\Nobitex
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Omnipay\Nobitex\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Sandbox Endpoint URL
     *
     * @var string URL
     */
    protected $testEndpoint = 'https://testnet.nobitex.market/app/paygate/';

    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'https://nobitex.market/app/paygate/';

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Does the response require a redirect?
     *
     * @return boolean
     */
    public function isRedirect()
    {
        return isset($this->data['status']) && $this->data['status'] === 'success';
    }

    /**
     * Gets the redirect target url.
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->getEndpoint() . $this->data['token'];
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->request->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
