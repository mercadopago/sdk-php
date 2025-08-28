<?php

namespace MercadoPago\Resources\Point;

/** Device class. */
class Device
{
    /** Device ID. */
    public ?string $id;

    /** POS ID. */
    public ?int $pos_id;

    /** Store ID. */
    public ?int $store_id;

    /** External POS ID. */
    public ?string $external_pos_id;

    /** Operating mode. */
    public ?string $operating_mode;
}
