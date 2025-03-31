<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/** Items class. */
class Items
{
    /** Title. */
    public ?string $title;

    /** Unit price. */
    public ?string $unit_price;

    /** Quantity. */
    public ?int $quantity;

    /** External code. */
    public ?string $external_code;

    /** Category ID. */
    public ?string $category_id;

    /** Description. */
    public ?string $description;

    /** Picture URL. */
    public ?string $picture_url;
}
