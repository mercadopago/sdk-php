<?php

namespace MercadoPago\Client\PaymentMethod;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\PaymentMethodResult;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing payment methods actions. */
final class PaymentMethodClient extends MercadoPagoClient
{
    private const URL = "/v1/payment_methods";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for list payment methods.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentMethodResult result from payment method found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function list(?RequestOptions $request_options = null): PaymentMethodResult
    {
        $response = parent::send(self::URL, HttpMethod::GET, null, null, $request_options);
        $result_data = array("data" => $response->getContent());
        $result = Serializer::deserializeFromJson(PaymentMethodResult::class, $result_data);
        $result->setResponse($response);
        return $result;
    }
}
