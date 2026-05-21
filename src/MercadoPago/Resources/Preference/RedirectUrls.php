<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Redirect URLs resource.
 *
 * Defines the redirect URLs used after the buyer completes checkout. Inherits
 * success, pending, and failure URL fields from {@see \MercadoPago\Resources\Preference\Urls}.
 * Unlike BackUrls, these are used for server-side redirects in specific integration flows.
 */
class RedirectUrls extends Urls
{
}
