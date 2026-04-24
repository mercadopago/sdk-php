<?php

namespace MercadoPago\Client\OAuth;

/**
 * Request payload for refreshing an expired OAuth access token.
 *
 * @see OAuthClient::refresh()
 */
class OAuthRefreshRequest
{
    /** Your application's client secret. */
    public string $client_secret;

    /** Your application's client ID. */
    public string $client_id;

    /** OAuth grant type. Fixed to "refresh_token" for this flow. */
    public string $grant_type = "refresh_token";

    /** The refresh token obtained from a previous token exchange. */
    public string $refresh_token;
}
