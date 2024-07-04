<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** ForwardData class. */
class ForwardData
{
    /** Class mapper. */
    use Mapper;

    public array|object|null $sub_merchant;


    private $map = [
        "sub_merchant" => "MercadoPago\Resources\Common\SubMerchant",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
