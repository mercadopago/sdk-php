<?php

namespace MercadoPago\Client\User;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Resources\User;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing user actions. */
final class UserClient extends MercadoPagoClient
{
    private const URL = "/users/me";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for getting user information.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\User user information.
     */
    public function get(?MPRequestOptions $request_options = null): User
    {
        try {
            $response = parent::send(sprintf(self::URL), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(User::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
