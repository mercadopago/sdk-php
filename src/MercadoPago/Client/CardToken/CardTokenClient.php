<?php

namespace MercadoPago\Client\CardToken;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Resources\CardToken;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing cardtoken actions. */
final class CardTokenClient extends MercadoPagoClient
{
    private const URL = "/v1/card_tokens";

    private const URL_WITH_ID = "/v1/card_tokens/%s";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating card token.
     * @param array $request card token data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CardToken card token created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(array $request, ?RequestOptions $request_options = null): CardToken
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(CardToken::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting card token by ID.
     * @param string $id card token ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CardToken card token found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(string $id, ?RequestOptions $request_options = null): CardToken
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(CardToken::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
