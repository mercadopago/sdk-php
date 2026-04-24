<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents a refund within a MercadoPago order transaction.
 *
 * Refunds can be total or partial, and are linked to the original payment
 * transaction. Each refund tracks its own amount, status, and the items
 * being returned.
 *
 * @see \MercadoPago\Resources\Order\Transactions
 * @see \MercadoPago\Client\Order\OrderClient
 */
class Refund
{
    /** Class mapper. */
    use Mapper;

    /** Unique identifier of the refund assigned by MercadoPago. */
    public ?string $id;

    /** Identifier of the original payment transaction being refunded. */
    public ?string $transaction_id;

    /** Seller-defined reference to correlate this refund with an external system. */
    public ?string $reference_id;

    /** Refund amount in the order's currency (partial or full). */
    public ?string $amount;

    /** Current refund status (e.g., "approved", "pending"). */
    public ?string $status;

    /** End-to-end transaction identifier for Pix refunds. */
    public ?string $e2e_id;

    /** Items being refunded. Each element maps to {@see Items}. */
    public ?array $items;

    private $map = [
        "transactions" => "MercadoPago\Resources\Order\Transactions",
        "items" => "MercadoPago\Resources\Order\Items",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
