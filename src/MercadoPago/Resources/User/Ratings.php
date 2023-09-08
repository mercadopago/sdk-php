<?php

namespace MercadoPago\Resources\User;

/** Ratings class. */
class Ratings
{
    /** The number of negative ratings. */
    public ?int $negative;

    /** The number of neutral ratings. */
    public ?int $neutral;

    /** The number of positive ratings. */
    public ?int $positive;
}
