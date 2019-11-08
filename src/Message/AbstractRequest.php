<?php

/**
 * @package Omnipay\Nobitex
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Omnipay\Nobitex\Message;

use Exception;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class AbstractRequest
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Sandbox Endpoint URL
     *
     * @var string URL
     */
    protected $testEndpoint = 'https://testnetapi.nobitex.market';

    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'https://api.nobitex.market';

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param string $value
     * @return AbstractRequest
     */
    public function setApiKey(string $value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get the gateway invoice token.
     *
     * @return string
     */
    public function getToken()
    {
        $value = $this->getParameter('token');
        $value = $value ?: $this->httpRequest->query->get('token');
        return $value;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send.
     * @return ResponseInterface
     * @throws InvalidResponseException
     */
    public function sendData($data)
    {
        try {
            $httpResponse = $this->httpClient->request(
                'POST',
                $this->createUri($this->getEndpoint()),
                [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                ],
                json_encode($data)
            );
            $json = $httpResponse->getBody()->getContents();
            $data = !empty($json) ? json_decode($json, true) : [];
            return $this->response = $this->createResponse($data);
        } catch (Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }

    /**
     * @param string $endpoint
     * @return string
     */
    abstract protected function createUri(string $endpoint);

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * @param array $data
     * @return AbstractResponse
     */
    abstract protected function createResponse(array $data);

    /**
     * @return string
     */
    protected function getCurrencies()
    {
        $value = $this->getParameter('currencies');
        $value = is_array($value) ? implode(',', $value) : $value;
        return $value;
    }

    /**
     * @return string
     */
    protected function getMobile()
    {
        return $this->getParameter('mobile');
    }
}
