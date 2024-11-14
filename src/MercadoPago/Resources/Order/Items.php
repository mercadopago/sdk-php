<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

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

    /** Item ID. */
    public ?string $id;

    /** Category ID. */
    public ?string $category_id;

    /** Description. */
    public ?string $description;

    /** Picture URL. */
    public ?string $picture_url;
}
