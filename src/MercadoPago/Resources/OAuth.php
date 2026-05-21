<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/**
 * OAuth resource.
 *
 * Represents an OAuth token response from the MercadoPago authorization server.
 * Contains the access token, refresh token, and associated metadata needed to
 * authenticate API requests on behalf of a seller (marketplace/platform integrations).
 *
 * @see \MercadoPago\Client\OAuth\OAuthClient
 */
class OAuth extends MPResource
{
    /** Access token. */
    public ?string $access_token;

    /** Token type. */
    public ?string $token_type;

    /** Expires in. */
    public ?int $expires_in;

    /** Scope. */
    public ?string $scope;

    /** User ID. */
    public ?int $user_id;

    /** Refresh token. */
    public ?string $refresh_token;

    /** Public key. */
    public ?string $public_key;

    /** Live mode. */
    public ?bool $live_mode;
}
