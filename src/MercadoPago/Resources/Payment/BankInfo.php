<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** BankInfo class. */
class BankInfo
{
    /** Class mapper. */
    use Mapper;

    /** Payer info. */
    public array|object|null $payer;

    /** Collector info. */
    public array|object|null $collector;

    /** Is same bank account owner. */
    public ?string $is_same_bank_account_owner;

    /** Origin bank ID. */
    public ?string $origin_bank_id;

    /** Origin wallet ID. */
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
