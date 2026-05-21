<?php

namespace MercadoPago\Client\User;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\User;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Users API (`/users/me`).
 *
 * Retrieves information about the authenticated MercadoPago user/seller
 * (account details, site, country, etc.).
 */
final class UserClient extends MercadoPagoClient
{
    private const URL = "/users/me";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Retrieves the authenticated user's account information.
     *
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return User The authenticated user's profile and account details.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(?RequestOptions $request_options = null): User
    {
        $response = parent::send(sprintf(self::URL), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(User::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
