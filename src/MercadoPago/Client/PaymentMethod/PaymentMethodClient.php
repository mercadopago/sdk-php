<?php

namespace MercadoPago\Client\PaymentMethod;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Resources\PaymentMethodResult;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing payment methods actions. */
final class PaymentMethodClient extends MercadoPagoClient
{
    private const URL = "/v1/payment_methods";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for getting array from payment methods.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentMethodResult result from payment method found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(?RequestOptions $request_options = null): PaymentMethodResult
    {
        $response = parent::send(self::URL, HttpMethod::GET, null, null, $request_options);
        $result_data = array("data" => $response->getContent());
        $result = Serializer::deserializeFromJson(PaymentMethodResult::class, $result_data);
        $result->setResponse($response);
        return $result;
    }
}
