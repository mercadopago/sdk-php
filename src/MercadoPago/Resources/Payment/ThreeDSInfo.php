<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents 3D Secure (3DS) authentication data for a card payment in the MercadoPago API.
 *
 * Contains the challenge URL and request payload needed to complete
 * 3DS cardholder verification when required by the issuer.
 * Nested within {@see \MercadoPago\Resources\Payment}.
 */
class ThreeDSInfo
{
    /** URL to the 3DS challenge page where the cardholder completes authentication. */
    public ?string $external_resource_url;

    /** Base64-encoded Challenge Request (CReq) message for the 3DS flow. */
    public ?string $creq;
}
