<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents bank account information for bank transfer payments in the MercadoPago API.
 *
 * Contains the bank details of both the payer and collector involved in
 * a bank transfer (e.g. Pix, TED) transaction. Nested within {@see TransactionData}.
 */
class BankInfo
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var BankInfoPayer|array|null Bank account details of the payer (buyer). */
    public array|object|null $payer;

    /** @var BankInfoCollector|array|null Bank account details of the collector (seller). */
    public array|object|null $collector;

    /** Whether the payer and collector share the same bank account ownership. */
    public ?string $is_same_bank_account_owner;

    /** Identifier of the originating bank in the transfer. */
    public ?string $origin_bank_id;

    /** Identifier of the originating digital wallet in the transfer. */
    public ?string $origin_wallet_id;

    private $map = [
        "payer" => "MercadoPago\Resources\Payment\BankInfoPayer",
        "collector" => "MercadoPago\Resources\Payment\BankInfoCollector",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
