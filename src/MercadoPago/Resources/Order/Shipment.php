<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

/** Shipment class. */
class Shipment
{
    /** Address. */
    public ?Address $address;

    private $map = [
      'address' => "MercadoPago\Resources\Common\Address",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }

}
