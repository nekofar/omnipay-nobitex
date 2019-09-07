<?php
/**
 * @package Omnipay\Nobitex
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Omnipay\Nobitex;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Nobitex\Message\PurchaseCompleteRequest;
use Omnipay\Nobitex\Message\PurchaseRequest;


/**
 * Class Gateway
 */
class Gateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName()
    {
        return 'Nobitex';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'testMode' => false,
            'apiKey' => '',
            'returnUrl' => '',
        ];
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setApiKey(string $value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setReturnUrl(string $value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest|RequestInterface
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest|RequestInterface
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseCompleteRequest::class, $parameters);
    }
}
