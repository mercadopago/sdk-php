<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents the application that originated the payment interaction.
 *
 * Nested within {@see PointOfInteraction} to identify which MercadoPago
 * application or integration generated the payment (e.g. QR code app).
 */
class ApplicationData
{
    /** Name of the originating application. */
    public ?string $name;

    /** Version of the originating application. */
    public ?string $version;
}
