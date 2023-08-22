<?php

namespace MercadoPago\Client\CardToken;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Resources\CardToken;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing cardtoken actions. */
class CardTokenClient extends MercadoPagoClient
{
    private static $URL = "/v1/card_tokens";

    private static $URL_WITH_ID = "/v1/card_tokens/%s";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating card token.
     * @param array $request card token data.
     * @return \MercadoPago\Resources\CardToken card token created.
     */
    public function create(array $request): CardToken
    {
        try {
            $response = parent::send(self::$URL, HttpMethod::POST, json_encode($request));
            $result = Serializer::deserializeFromJson(CardToken::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for getting card token by id.
     * @param string $id card token id.
     * @return \MercadoPago\Resources\CardToken card token found.
     */
    public function get(string $id): CardToken
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID, $id), HttpMethod::GET);
            $result = Serializer::deserializeFromJson(CardToken::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
