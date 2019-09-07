<?php
/**
 * @package Omnipay\Nobitex
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Omnipay\Nobitex\Message;

/**
 * Class AbstractResponse
 */
abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /**
     * The embodied request object.
     *
     * @var AbstractRequest
     */
    protected $request;

    /**
     * @var array
     */
    private $errorCodes = [
        '-1' => 'API parameter is required.',
        '-2' => 'API not found.',
        '-3' => 'API is restricted.',
        '-4' => 'API is invalid.',
        '-5' => 'Amount parameter is required.',
        '-6' => 'Amount must be integer.',
        '-7' => 'Amount min value is 10,000 rls.',
        '-8' => 'callbackURL parameter is required.',
        '-9' => 'callbackURL CORPS error.',
        '-10' => 'callbackURL format is invalid. Please use this format: https://domain.com/path/to/redirect',
        '-11' => 'Description must be less than 255 character.',
        '-21' => 'Invalid token.',
        '-22' => 'Token not found.',
        '-23' => 'Token is required.',
        '-31' => 'Unverified.',
        '-32' => 'Verified before',
        '-41' => 'Invalid currency',
    ];

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return isset($this->errorCodes[$this->getCode()]) ? $this->errorCodes[$this->getCode()] : parent::getMessage();
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        return isset($this->data['code']) ? $this->data['code'] : parent::getCode();
    }
}
