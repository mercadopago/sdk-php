<?php

namespace MercadoPago\Resources\Common;

/**
 * Represents pagination metadata returned by MercadoPago search/list endpoints.
 *
 * Included in paginated API responses (e.g. {@see \MercadoPago\Resources\PaymentSearch})
 * to indicate the total result count and current page position.
 */
class Paging
{
    /** Total number of results matching the search criteria. */
    public ?int $total;

    /** Total number of pages available. */
    public ?int $total_pages;

    /** Maximum number of results returned per page. */
    public ?int $limit;

    /** Number of results skipped from the beginning of the result set. */
    public ?int $offset;
}
