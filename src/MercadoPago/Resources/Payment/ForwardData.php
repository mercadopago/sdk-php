<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents data forwarded to payment acquirers/processors in the MercadoPago API.
 *
 * Used in payment facilitator (PayFac) and gateway integrations to send
 * sub-merchant details and network transaction references to the acquirer.
 * Nested within {@see \MercadoPago\Resources\Payment}.
 */
class ForwardData
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var \MercadoPago\Resources\Common\SubMerchant|array|null Sub-merchant identification and address data for PayFac flows. */
    public array|object|null $sub_merchant;

    /** @var NetworkTransactionData|array|null Network transaction identifiers for recurring/installment card payments. */
    public array|object|null $network_transaction_data;

    private $map = [
        "sub_merchant" => "MercadoPago\Resources\Common\SubMerchant",
        "network_transaction_data" => "MercadoPago\Resources\Payment\NetworkTransactionData",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
