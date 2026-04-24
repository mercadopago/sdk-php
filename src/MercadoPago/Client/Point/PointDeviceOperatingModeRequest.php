<?php

namespace MercadoPago\Client\Point;

/**
 * Request payload for changing a Point device's operating mode.
 *
 * @see PointClient::changeDeviceOperatingMode()
 */
class PointDeviceOperatingModeRequest
{
    /** Target operating mode (e.g., "PDV", "STANDALONE"). */
    public string $operating_mode;
}
