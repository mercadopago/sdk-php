<?php

namespace MercadoPago\Client\CardToken;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
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
     * @param \MercadoPago\Core\MPRequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CardToken card token created.
     */
    public function create(array $request, ?MPRequestOptions $request_options = null): CardToken
    {
        try {
            $response = parent::send(self::$URL, HttpMethod::POST, json_encode($request), null, $request_options);
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
     * @param \MercadoPago\Core\MPRequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CardToken card token found.
     */
    public function get(string $id, ?MPRequestOptions $request_options = null): CardToken
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(CardToken::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
