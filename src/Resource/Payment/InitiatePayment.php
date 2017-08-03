<?php

namespace Vipps\Resource\Payment;

use Vipps\Model\Payment\RequestInitiatePayment;
use Vipps\Model\Payment\ResponseInitiatePayment;
use Vipps\Resource\HttpMethod;
use Vipps\VippsInterface;

/**
 * Class InitiatePayment
 *
 * @package Vipps\Resource\Payment
 */
class InitiatePayment extends PaymentResourceBase
{

    /**
     * @var \Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments';

    /**
     * InitiatePayment constructor.
     *
     * @param \Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param \Vipps\Model\Payment\RequestInitiatePayment $requestObject
     */
    public function __construct(VippsInterface $vipps, $subscription_key, RequestInitiatePayment $requestObject)
    {
        parent::__construct($vipps, $subscription_key);
        $this->body = $this
            ->getSerializer()
            ->serialize(
                $requestObject,
                'json'
            );
    }

    /**
     * @return \Vipps\Model\Payment\ResponseInitiatePayment
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \Vipps\Model\Payment\ResponseInitiatePayment $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseInitiatePayment::class,
                'json'
            );

        return $responseObject;
    }
}
