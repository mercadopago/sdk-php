<?php

namespace MercadoPago\Resources\User;

/** Sales class. */
class Sales
{
    /** The sales period (e.g., "365 days"). */
    public ?string $period;

    /** The number of completed sales. */
    public ?int $completed;
}
