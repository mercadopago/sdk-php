<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/**
 * Point Device Operating Mode resource.
 *
 * Represents the operating mode configuration of a Point smart terminal device.
 * The operating mode determines how the device processes transactions
 * (e.g. "PDV" for point-of-sale integration, "STANDALONE" for independent use).
 *
 * @see \MercadoPago\Client\Point\PointClient
 */
class PointDeviceOperatingMode extends MPResource
{
    /** Operating mode. */
    public string $operating_mode;
}
