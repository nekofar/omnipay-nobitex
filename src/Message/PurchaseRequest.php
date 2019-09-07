<?php
/**
 * @package Omnipay\Nobitex
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Omnipay\Nobitex\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class PurchaseRequest
 */
class PurchaseRequest extends AbstractRequest
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
        $this->validate('apiKey', 'amount', 'returnUrl');

        return [
            'api' => $this->getApiKey(),
            'amount' => $this->getAmount(),
            'callbackURL' => $this->getReturnUrl(),
            'factorNumber' => $this->getTransactionId(),
            'mobile' => $this->getMobile(),
            'description' => $this->getDescription(),
            'currencies' => $this->getCurrencies()
        ];
    }

    /**
     * @param string $endpoint
     * @return string
     */
    protected function createUri(string $endpoint)
    {
        return $endpoint . '/pg/send/';
    }

    /**
     * @param array $data
     * @return PurchaseResponse
     */
    protected function createResponse(array $data)
    {
        return new PurchaseResponse($this, $data);
    }
}
