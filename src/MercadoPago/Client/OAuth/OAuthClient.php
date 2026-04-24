<?php

namespace MercadoPago\Client\OAuth;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\OAuth;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the OAuth Authorization API.
 *
 * Handles the full OAuth 2.0 authorization code flow: building the authorization URL,
 * exchanging the code for an access token, and refreshing expired tokens.
 * Used to operate on behalf of other MercadoPago sellers (marketplace scenario).
 *
 * @see https://www.mercadopago.com/developers/en/docs/security/oauth/creation
 */
final class OAuthClient extends MercadoPagoClient
{
    private const AUTH_URL = "https://auth.mercadopago.com/authorization";

    private const URL = "/oauth/token";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Builds the authorization URL where the seller grants permission to your application.
     *
     * Redirect the seller to this URL to start the OAuth flow. After authorization,
     * MercadoPago redirects back to your `redirect_uri` with a `code` parameter.
     *
     * @param string $app_id      Your application's client ID.
     * @param string $redirect_uri URI where MercadoPago redirects after authorization.
     * @param string $random_id    CSRF protection state parameter (should be unique per request).
     * @return string Full authorization URL with query parameters.
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
     * Exchanges an authorization code for an access token.
     *
     * Call this after the seller is redirected back to your `redirect_uri` with the `code` parameter.
     *
     * @param OAuthCreateRequest $request Contains client_id, client_secret, code, and redirect_uri.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return OAuth Token response with access_token, refresh_token, and expiration.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(OAuthCreateRequest $request, ?RequestOptions $request_options = null): OAuth
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(OAuth::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Refreshes an expired access token using a refresh token.
     *
     * @param OAuthRefreshRequest $request Contains client_id, client_secret, and refresh_token.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return OAuth New token response with fresh access_token and refresh_token.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function refresh(OAuthRefreshRequest $request, ?RequestOptions $request_options = null): OAuth
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(OAuth::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
