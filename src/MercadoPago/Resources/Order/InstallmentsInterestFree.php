<?php

namespace MercadoPago\Resources\Order;

/** InstallmentsInterestFree class. */
class InstallmentsInterestFree
{
    /** Interest-free installment type. */
    public ?string $type = null;

    /** List of available interest-free installment numbers. */
    public ?array $values = null;
}
