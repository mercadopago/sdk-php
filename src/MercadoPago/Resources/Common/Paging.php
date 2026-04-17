<?php

namespace MercadoPago\Resources\Common;

/** Paging class. */
class Paging
{
    /** Total. */
    public ?int $total;

    /** Total pages. */
    public ?int $total_pages;

    /** Limit. */
    public ?int $limit;

    /** Offset. */
    public ?int $offset;
}
