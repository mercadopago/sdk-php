<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** PointDevices class. */
class PointDevices extends MPResource
{
    /** Search paging. */
    public array $paging;

    /** Devices. */
    public array $devices;
}
