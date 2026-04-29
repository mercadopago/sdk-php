<?php

namespace MercadoPago\Client\CardToken;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\CardToken;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Card Tokens API (`/v1/card_tokens`).
 *
 * Card tokens are single-use representations of credit/debit card data used
 * to create payments without exposing raw card details to the merchant's server.
 *
 * @see https://www.mercadopago.com/developers/en/reference
 */
final class CardTokenClient extends MercadoPagoClient
{
    private const URL = "/v1/card_tokens";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a single-use card token from card data.
     *
     * @param array<string,mixed> $request Card data (card_number, expiration_month, expiration_year, security_code, cardholder).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return CardToken The created card token resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(array $request, ?RequestOptions $request_options = null): CardToken
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(CardToken::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
