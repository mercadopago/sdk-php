<?php

namespace MercadoPago\Client\User;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\User;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing user actions. */
final class UserClient extends MercadoPagoClient
{
    private const URL = "/users/me";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for getting user information.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\User user information.
     * @throws \MercadoPago\Exceptions\MPApiException if the API responds with an error.
     * @throws \Exception if the request fails.
     */
    public function get(?RequestOptions $request_options = null): User
    {
        $response = parent::send(sprintf(self::URL), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(User::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
