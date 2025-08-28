<?php

namespace MercadoPago\Resources\MerchantOrder;

class Item
{
    /** Item code. */
    public ?string $id;

    /** Item name. */
    public ?string $title;

    /** Item description. */
    public ?string $description;

    /** Image URL. */
    public ?string $picture_url;

    /** Category of the item. */
    public ?string $category_id;

    /** Item's quantity. */
    public ?int $quantity;

    /** Unit price. */
    public ?float $unit_price;

    /** Currency ID. ISO_4217 code. */
    public ?string $currency_id;
}
