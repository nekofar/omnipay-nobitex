<?php
/**
 * @package Omnipay\Nobitex
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Omnipay\Nobitex\Message;

/**
 * Class PurchaseCompleteRequest
 */
class PurchaseCompleteRequest extends AbstractRequest
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
     * @return PurchaseCompleteResponse
     */
    protected function createResponse(array $data)
    {
        return new PurchaseCompleteResponse($this, $data);
    }
}
