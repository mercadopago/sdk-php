<?php

namespace MercadoPago\Resources\Preference;

/** TrackValues class. */
class TrackValues
{
    /** conversion_id for GTM Google Ads Conversion Tracking tag. */
    public ?string $conversion_id;

    /** conversion_label for GTM Google Ads Conversion Tracking tag. */
    public ?string $conversion_label;

    /** pixel_id for Facebook Pixel. */
    public ?string $pixel_id;
}
