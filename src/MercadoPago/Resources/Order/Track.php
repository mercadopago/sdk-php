<?php

namespace MercadoPago\Resources\Order;

/**
 * Represents a tracking pixel fired at checkout completion.
 *
 * Supports Google Ads and Facebook Ads tracking to attribute conversions
 * from the Checkout PRO flow. Configured within {@see OnlineConfig}.
 *
 * @see \MercadoPago\Resources\Order\OnlineConfig
 */
class Track
{
    /** Tracking pixel type. Accepted values: "google_ad" or "facebook_ad". */
    public ?string $type;

    /**
     * Key-value pairs specific to the tracking type.
     * For "google_ad": conversion_id and conversion_label.
     * For "facebook_ad": pixel_id.
     */
    public ?array $values;
}
