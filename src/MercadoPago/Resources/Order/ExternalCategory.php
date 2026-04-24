<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

/**
 * Represents an external product category associated with an order item.
 *
 * Used to classify items according to the seller's own category taxonomy,
 * which can influence fraud analysis and payment processing rules.
 *
 * @see \MercadoPago\Resources\Order\Items
 */
class ExternalCategory
{
    /** Seller-defined category identifier for the item. */
    public ?string $id;
}
