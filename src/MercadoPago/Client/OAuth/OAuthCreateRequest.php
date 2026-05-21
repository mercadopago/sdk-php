<?php

namespace MercadoPago\Client\OAuth;

/**
 * Request payload for exchanging an authorization code for an OAuth access token.
 *
 * @see OAuthClient::create()
 */
class OAuthCreateRequest
{
    /** Your application's client secret. */
    public string $client_secret;

    /** Your application's client ID. */
    public string $client_id;

    /** OAuth grant type. Fixed to "authorization_code" for this flow. */
    public string $grant_type = "authorization_code";

    /** Authorization code received from the OAuth redirect. */
    public string $code;

    /** Must match the redirect_uri used when building the authorization URL. */
    public string $redirect_uri;
}
