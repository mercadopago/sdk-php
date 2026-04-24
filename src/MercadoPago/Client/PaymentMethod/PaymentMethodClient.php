<?php

namespace MercadoPago\Client\PaymentMethod;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\PaymentMethodResult;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Payment Methods API (`/v1/payment_methods`).
 *
 * Lists the payment methods (credit cards, debit cards, bank transfers, etc.)
 * available for the country associated with the access token.
 */
final class PaymentMethodClient extends MercadoPagoClient
{
    private const URL = "/v1/payment_methods";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Lists all available payment methods for the current country.
     *
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentMethodResult Collection of available payment method resources.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
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
