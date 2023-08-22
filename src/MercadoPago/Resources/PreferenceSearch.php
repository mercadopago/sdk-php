<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** PreferenceSearch class. */
class PreferenceSearch extends MPResource
{
    /** Search elements. */
    public array $elements;

    /** Search next offset. */
    public ?int $next_offset;

    /** Search total. */
    public ?int $total;
}
