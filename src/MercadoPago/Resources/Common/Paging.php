<?php

namespace MercadoPago\Resources\Common;

/** Paging class. */
class Paging
{
    /** Total. */
    public ?string $total;

    /** Total pages. */
    public ?string $total_pages;

    /** Limit. */
    public ?string $limit;

    /** Offset. */
    public ?string $offset;
}
