<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** TransactionSecurity class. */
class TransactionSecurity
{
    /** Class mapper. */
    use Mapper;

    /** Validation. */
    public ?string $validation;

    /** Liability shift. */
    public ?string $liability_shift;

    /** URL. */
    public ?string $url;

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return [];
    }
}

