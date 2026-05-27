<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Disbursement Refund List resource.
 *
 * Represents the list of disbursement refunds returned when listing all refunds
 * for an advanced payment via `GET /v1/advanced_payments/{id}/refunds`.
 *
 * @property array|object|null $refunds Refund list, mapped to {@see \MercadoPago\Resources\DisbursementRefund}.
 *
 * @see \MercadoPago\Client\DisbursementRefund\DisbursementRefundClient
 */
class DisbursementRefundList extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** List of disbursement refunds. */
    public array|object|null $refunds;

    private $map = [
        "refunds" => "MercadoPago\Resources\DisbursementRefund",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
