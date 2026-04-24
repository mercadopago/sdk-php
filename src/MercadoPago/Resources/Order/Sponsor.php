<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/**
 * Represents a sponsor account within the order's integration data.
 *
 * A sponsor is a MercadoPago account that receives a portion of the fees
 * when orders are created through a marketplace or platform integration.
 *
 * @see \MercadoPago\Resources\Order\IntegrationData
 */
class Sponsor
{
    /** MercadoPago account ID of the sponsor. */
    public ?string $id;
}
