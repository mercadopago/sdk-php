<?php

namespace MercadoPago\Client\OAuth;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\OAuth;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing OAuth authorizartion. */
final class OAuthClient extends MercadoPagoClient
{
    private const AUTH_URL = "https://auth.mercadopago.com";

    private const URL = "/oauth/token";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Function responsible for generating the authorization URL.
     * @param string $app_id application ID.
     * @param string $redirect_uri redirect uri.
     * @return string authorization url.
     */
    public function getAuthorizationURL(string $app_id, string $redirect_uri, string $random_id): string
    {
        $query_params = [
            "client_id" => $app_id,
            "response_type" => "code",
            "platform_id" => "mp",
            "state" => $random_id,
            "redirect_uri" => $redirect_uri
        ];

        $query_string = http_build_query($query_params);
        return OAuthClient::AUTH_URL . '?' . $query_string;
    }

    /**
     * Method responsible for creating the necessary token to operate your application in the name of a seller.
     * @param OAuthCreateRequest $request request parameters.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\OAuth oauth information.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(OAuthCreateRequest $request, ?RequestOptions $request_options = null): OAuth
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(OAuth::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for refreshing the necessary token to operate your application in the name of a seller.
     * @param OAuthRefreshRequest $request request parameters.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\OAuth oauth information.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function refresh(OAuthRefreshRequest $request, ?RequestOptions $request_options = null): OAuth
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(OAuth::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
