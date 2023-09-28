<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** OAuth class. */
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
