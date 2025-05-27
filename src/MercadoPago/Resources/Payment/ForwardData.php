<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** ForwardData class. */
class ForwardData
{
    /** Class mapper. */
    use Mapper;

    public array|object|null $sub_merchant;

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
