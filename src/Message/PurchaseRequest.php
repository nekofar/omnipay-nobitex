<?php
/**
 * @package Omnipay\Nobitex
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Omnipay\Nobitex\Message;

/**
 * Class PurchaseRequest
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @param string $endpoint
     * @return string
     */
    protected function createUri(string $endpoint)
    {
        // TODO: Implement createUri() method.
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
