<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Back URLs resource.
 *
 * Defines the callback URLs where the buyer is redirected after completing, cancelling,
 * or encountering a pending state during the MercadoPago Checkout flow. Inherits
 * success, pending, and failure URL fields from {@see \MercadoPago\Resources\Preference\Urls}.
 */
class BackUrls extends Urls
{
}
