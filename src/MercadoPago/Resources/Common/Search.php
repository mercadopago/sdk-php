<?php

namespace MercadoPago\Resources\Common;

use MercadoPago\Net\MPResource;

/** Search class. */
class Search extends MPResource
{
    /** Search elements. */
    public array $elements;

    /** Search next offset. */
    public ?int $next_offset;

    /** Search total. */
    public ?int $total;
}
