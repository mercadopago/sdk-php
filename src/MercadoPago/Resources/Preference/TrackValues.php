<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Track Values resource.
 *
 * Contains the platform-specific identifiers for conversion tracking. For Google Ads,
 * provides conversion_id and conversion_label (used with GTM). For Facebook, provides
 * the pixel_id for the Facebook Pixel.
 */
class TrackValues
{
    /** conversion_id for GTM Google Ads Conversion Tracking tag. */
    public ?string $conversion_id;

    /** conversion_label for GTM Google Ads Conversion Tracking tag. */
    public ?string $conversion_label;

    /** pixel_id for Facebook Pixel. */
    public ?string $pixel_id;
}
