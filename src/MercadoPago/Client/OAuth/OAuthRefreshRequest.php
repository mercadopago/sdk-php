<?php

namespace MercadoPago\Client\OAuth;

/** OAuthRefreshRequest class. */
class OAuthRefreshRequest
{
    /** Client secret. */
    public string $client_secret;

    /** Client ID. */
    public string $client_id;

    /** Grant type. */
    public string $grant_type = "refresh_token";

    /** Refresh token. */
    public string $refresh_token;

    /** Code. */
    public string $code;

    /** Redirect URI. */
    public string $redirect_uri;
}
