<?php

namespace MercadoPago\Client\OAuth;

/** OAuthCreateRequest class. */
class OAuthCreateRequest
{
    /** Client secret. */
    public string $client_secret;

    /** Client ID. */
    public string $client_id;

    /** Grant type. */
    public string $grant_type = "authorization_code";

    /** Code. */
    public string $code;

    /** Redirect URI. */
    public string $redirect_uri;
}
