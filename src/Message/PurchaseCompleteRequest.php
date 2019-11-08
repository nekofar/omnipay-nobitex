<?php

/**
 * @package Omnipay\Nobitex
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Omnipay\Nobitex\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class PurchaseCompleteRequest
 */
class PurchaseCompleteRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        // Validate required parameters before return data
        $this->validate('apiKey', 'token');

        return [
            'apiKey' => $this->getApiKey(),
            'token' => $this->getToken(),
        ];
    }

    /**
     * @param string $endpoint
     * @return string
     */
    protected function createUri(string $endpoint)
    {
        return $endpoint . '/pg/verify/';
    }

    /**
     * @param array $data
     * @return PurchaseCompleteResponse
     */
    protected function createResponse(array $data)
    {
        return new PurchaseCompleteResponse($this, $data);
    }
}
